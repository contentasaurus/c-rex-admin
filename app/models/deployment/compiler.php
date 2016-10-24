<?php

use \puffin\model\pdo as pdo;
use \contentasaurus\NodePhpProcess as node_php_process;

class deployment_compiler extends pdo
{
	private $scripts = [
		'site' => [
			'js-head' => [],
			'js-body' => [],
			'css' => []
		],
		'comp' => [
			'js-head' => [],
			'js-body' => [],
			'css' => []
		]
	];
	private $components = [];
	private $formatted = [];
	private $output = '';

	public function run( $type, &$output = false )
	{
		$this->get_site_scripts( $type );
		$this->get_components();
		$this->format( $type );
		$this->process( $type );
		$output = $this->output;
		return $this;
	}

	private function get_site_scripts( $type ) 
	{
		if( !empty($this->scripts['site'][$type]) ) return;

		$script = new script();
		$scripts = $script->get_by_type( $type );
		$this->scripts['site'][$type] = $scripts;
	}

	private function get_components()
	{
		if( !empty($this->components) ) return;

		$sql = "SELECT name, css, `js-head`, `js-body` 
				FROM deployable_components";

		$this->components = $this->select( $sql );

		$types = [
			'js-head',
			'js-body',
			'css'
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
			'init_script__' => ''
		];

		foreach ($this->scripts['site'][$type] as $script) 
		{
			$formatted['site_'.$script['name']] = $script['content'];

			if( $type == 'css' )
			{
				$formatted['init_script__'] 
					.= "@import 'site_{$script['name']}';".PHP_EOL;
			}
			else 
			{
				$formatted['init_script__']
					.= "require('site_{$script['name']}');".PHP_EOL;
			}				
		}

		foreach ($this->scripts['comp'][$type] as $script) 
		{
			$formatted[$script['name']] = $script['content'];

			if( $type == 'css' )
			{
				$formatted['init_script__'] 
					.= "@import '{$script['name']}';".PHP_EOL;
			}
			else 
			{
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
				'compile_path' => NODE_PATH
			],
			'modules' => $this->formatted
		];

		$process = new node_php_process();
		$process
			->script_path( NODE_PATH )
			->content( $formatted_components );

		if( $type == 'css')
		{
			$process->run( 'scss_compiler' );
		}
		else
		{
			$process->run( 'js_compiler' );
		}

		$process->output( $output );

		$this->output = $output;
	}
}