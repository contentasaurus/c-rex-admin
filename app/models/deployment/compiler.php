<?php

use \puffin\model\pdo as pdo;
use \contentasaurus\NodePhpProcess as node_php_process;

class deployment_compiler extends pdo
{
	private $scripts = [
		'site' => [
			'js-head' => [],
			'js-body' => [],
			'scss' => []
		],
		'comp' => [
			'js-head' => [],
			'js-body' => [],
			'scss' => []
		]
	];
	private $components = [];
	private $formatted = [];
	private $output = '';
	private $layout_name = '';
	private $version_id = -1;

	public function run( $type, &$output = false )
	{
		$this->get_site_scripts( $type );
		$this->get_components();
		$this->format( $type );
		$this->process( $type );
		
		$output = $this->output;

		return $this;
	}

	public function layout_name( $layout_name )
	{
		if( is_string($layout_name) )
		{
			$this->layout_name = $layout_name;
		}
		else
		{
			trigger_error("must be a string", E_USER_ERROR);
		}

		return $this;
	}

	public function version_id( $version_id )
	{
		if( is_int($version_id) )
		{
			$this->version_id = $version_id;
		}
		else
		{
			trigger_error("must be an integer", E_USER_ERROR);
		}

		return $this;
	}

	private function get_site_scripts( $type ) 
	{
		if( !empty($this->scripts['site'][$type]) ) return;

		$sql = '';

		if($this->version_id > 0)
		{
			$sql = "SELECT
						ds.name AS name,
						ds.html AS content
					FROM 
						deployable_scripts ds
					JOIN 
						page_versions pv 
						ON 
							pv.page_layout_id = ds.layout_id 
						AND 
							pv.id = :version_id
						AND 
							ds.script_type = :type
					ORDER BY
						ds.load_order 
						ASC";

			$params = [
				'version_id' => $this->version_id,
				'type' => $type
			];
		}

		else if(!empty($this->layout_name))
		{
			$sql = "SELECT
						ds.name AS name,
						ds.html AS content
					FROM
						deployable_scripts ds
					WHERE
						ds.layout_name = :layout_name
						AND
							ds.script_type = :type
					ORDER BY
						ds.load_order 
						ASC";

			$params = [
				'layout_name' => $this->layout_name,
				'type' => $type
			];
		}

		if(count($sql)) 
		{
			$this->scripts['site'][$type] = $this->select( $sql, $params );
		}
		else
		{
			trigger_error("No layout_name or version_id defined", E_USER_ERROR);
		}

		return $this;
	}

	private function get_components()
	{
		if( !empty($this->components) ) return;

		$sql = "SELECT name, scss, `js-head`, `js-body` 
				FROM deployable_components";

		$this->components = $this->select( $sql );

		$types = [
			'js-head',
			'js-body',
			'scss'
		];

		foreach( $this->components as $component ) 
		{
			foreach( $types as $type ) 
			{
				if( !empty($component[$type]) )
				{
					array_push(
						$this->scripts['comp'][$type], 
						[
							'name' => $component['name'],
							'content' => $component[$type]
						]
					);
				}
			}
		}

		return $this->components;
	}

	private function format( $type )
	{
		$formatted = [
			'init_script__' => ''.PHP_EOL
		];

		foreach ($this->scripts['site'][$type] as $script) 
		{

			if( $type == 'scss' )
			{
				$formatted['_site_'.$script['name']] = $script['content'];
				$formatted['init_script__'] 
					.= "@import '_site_{$script['name']}';".PHP_EOL;
			}
			else 
			{
				$formatted['site_'.$script['name']] = $script['content'];
				$formatted['init_script__']
					.= "require('site_{$script['name']}');".PHP_EOL;
			}				
		}

		foreach ($this->scripts['comp'][$type] as $script) 
		{

			if( $type == 'scss' )
			{
				$formatted['_'.$script['name']] = $script['content'];
				$formatted['init_script__'] 
					.= "@import '_{$script['name']}';".PHP_EOL;
			}
			else 
			{
				$formatted[$script['name']] = $script['content'];
				$formatted['init_script__']
					.= "require('{$script['name']}');".PHP_EOL;
			}				
		}

		$this->formatted = $formatted;
	}

	private function process( $type ) 
	{
		$formatted_components = [
			'options' => [
				'compile_path' => NODE_PATH,
				'output_path' => PUBLIC_PATH.'/preview',
				'filename' => $type
			],
			'modules' => $this->formatted
		];

		$process = new node_php_process();
		$process
			->script_path( NODE_PATH )
			->content( $formatted_components );

		if( $type == 'scss')
		{
			$process->run( 'scss_compiler' );
		}
		else
		{
			$process->run( 'js_compiler' );
		}
		$process->output( $output );
		// vd($output);
		$this->output = $output;
	}
}