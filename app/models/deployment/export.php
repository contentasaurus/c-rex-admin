<?php

use \puffin\model\pdo as pdo;
use \puffin\controller\param as param;

class deployment_export extends pdo
{
	protected $table = '';
	protected $connection = 'default';

	protected $key = 'PREVIEW';
	protected $export = [];
	protected $verification = 'false';
	protected $helpers = [];
	protected $components = [];
	protected $components_html = [];
	protected $components_css = '';
	protected $components_js = '';
	protected $components_nonblocking_js = '';

	public function __construct()
	{
		$this->hbs = new handlebars();
		$this->compiler = new deployment_compiler();
	}

	#========================================================================
	#
	#	EXPORT TABLES TO REMOTE DB
	#
	#========================================================================

	public function set_key( $key )
	{
		$this->key = $key;
		return $this;
	}

	public function get_key()
	{
		return $this->key;
	}

	public function make()
	{
		$this->verification = false;

		$this->export[ $this->get_key() ]['pages'] = $this->get_pages();
		$this->export[ $this->get_key() ]['site_data'] = $this->get_site_data();
		$this->export[ $this->get_key() ]['page_data'] = $this->get_page_data();
		$this->export[ $this->get_key() ]['components'] = $this->get_components();
		$this->export[ $this->get_key() ]['layouts'] = $this->get_layouts();
		$this->export[ $this->get_key() ]['scripts'] = $this->get_component_scripts();

		return $this;
	}

	public function get_pages()
	{
		$pages = $this->select( 'SELECT * from deployable_pages' );

		$return = [];
		foreach( $pages as $page )
		{
			$page['for_render'] = $this->build( $page['version_id'] );
			$return []= $page;
		}

		return $return;
	}

	public function get_component_scripts()
	{
		$this
			->compiler
			->run('js-head', $head_js)
			->run('js-body', $body_js)
			->run('scss', $css);

		$return = [
			['name' => 'component.head.js', 'content' => $head_js ],
			['name' => 'component.body.js', 'content' => $body_js ],
			['name' => 'component.css', 'content' => $css ]
		];

		return $return;
	}

	public function get_site_data()
	{
		return $this->select( 'SELECT * from deployable_site_data' );
	}

	public function get_page_data()
	{
		return $this->select( 'SELECT * from deployable_page_data' );
	}

	public function get_data_for_preview( $page_id )
	{
		$param = new param([]); #need a blank and empty object

		return [
			'Get' => $param->sanitize($_GET),
			'Page' => $this->get_page_data_for_preview($page_id),
			'Post' => $param->sanitize($_POST),
			'Server' => $_SERVER,
			'Session' => $_SESSION,
			'Site' => $this->get_site_data_for_preview(),
			'Cookie' => $_COOKIE
		];
	}

	public function get_site_data_for_preview()
	{
		$sql = 'SELECT
					reference_name,
					content
				FROM site_data';

		$params = [];

		$data = $this->select( $sql, $params );

		$return = [];
		foreach( $data as $datum )
		{
			$return[$datum['reference_name']] = json_decode($datum['content'], $assoc = true);
		}

		return $return;
	}

	public function get_page_data_for_preview( $page_id )
	{
		$sql = 'SELECT
					reference_name,
					content
				FROM page_data
				WHERE page_id = :page_id';

		$params = [
			':page_id' => $page_id
		];

		$data = $this->select( $sql, $params );

		$return = [];
		foreach( $data as $datum )
		{
			$return[$datum['reference_name']] = json_decode($datum['content'], $assoc = true);
		}

		$param = new param([]); #need a blank and empty object

		return $return;
	}


	public function get_components()
	{
		if( empty($this->components) )
		{
			$sql = "SELECT *
					FROM deployable_components
					ORDER BY priority DESC";

			$this->components = $this->select( $sql );
		}

		return $this->components;
	}

	public function get_layouts()
	{
		return $this->select( 'SELECT * from deployable_layouts' );
	}

	public function get_layout_for_compile( $layout_name )
	{
		$sql = 'SELECT content
				FROM deployable_layouts
				WHERE layout_name = :layout_name';

		$params = [
			':layout_name'=>$layout_name
		];

		return $this->select_one( $sql, $params );
	}

	#========================================================================
	#
	#	These methods use a different datasource. Please return to default
	#
	#========================================================================

	#datasource_deploy
	public function create_tables()
	{
		$this->connection = 'datasource_deploy';

		foreach( $this->export as $key => $table )
		{
			foreach( $table as $tablename => $resultset )
			{
				$sql = "CREATE TABLE IF NOT EXISTS {$key}_{$tablename} LIKE __{$tablename}_template";
				$this->execute($sql, []);

				$this->table = "{$key}_{$tablename}";

				foreach( $resultset as $index => $row )
				{
					$this->create( $row );
				}
			}
		}

		$this->connection = 'default';

		return $this;
	}

	#datasource_deploy
	public function verify_tables()
	{
		$this->connection = 'datasource_deploy';

		$verification = [];

		foreach( $this->export as $key => $table )
		{
			foreach( $table as $tablename => $resultset )
			{
				$sql = "SELECT count(0) as num FROM {$key}_{$tablename}";
				$count = $this->select_one($sql, []);

				$verification []= ($count == count($resultset));
			}
		}

		if( in_array( false, $verification ) )
		{
			$this->verification = false;
		}
		else
		{
			$this->verification = true;
		}

		$this->connection = 'default';

		return $this;
	}

	#datasource_deploy
	public function alter_views()
	{
		$this->connection = 'datasource_deploy';

		if( $this->verification )
		{
			foreach( $this->export as $key => $table )
			{
				foreach( $table as $tablename => $resultset )
				{
					$sql = "CREATE OR REPLACE VIEW {$tablename} AS
							SELECT * FROM {$key}_{$tablename}";
					$this->execute($sql, []);
				}
			}

			$this->table = '___recent_deployments';

			$this->execute("UPDATE {$this->table} SET is_current = 0", [] );

			$this->create([
				'deployment_key' => $this->get_key(),
				'deployed_by' => "{$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']}",
				'is_current' => 1
			]);
		}

		$this->connection = 'default';

		return $this;
	}

	#datasource_deploy
	public function rollback_views( $rollback_key )
	{
		$this->connection = 'datasource_deploy';

		$rollback[ $rollback_key ]['pages'] = '';
		$rollback[ $rollback_key ]['site_data'] = '';
		$rollback[ $rollback_key ]['page_data'] = '';
		$rollback[ $rollback_key ]['components'] = '';
		$rollback[ $rollback_key ]['layouts'] = '';
		$rollback[ $rollback_key ]['scripts'] = '';

		foreach( $rollback as $key => $table )
		{
			foreach( $table as $tablename => $resultset )
			{
				$sql = "CREATE OR REPLACE VIEW {$tablename} AS
						SELECT * FROM {$key}_{$tablename}";
				$this->execute($sql);
			}
		}

		$this->table = '___recent_deployments';

		$this->execute("UPDATE {$this->table} SET is_current = 0");

		$sql = "UPDATE {$this->table}
				SET is_current = 1
				WHERE deployment_key = :deployment_key";

		$params = [
			':deployment_key' => $rollback_key
		];

		$this->execute($sql, $params);

		$this->connection = 'default';
	}

	#========================================================================
	#
	#	PAGE CONTENT RENDERING
	#
	#========================================================================

	public function preview( $version_id = false )
	{
		$partials = $this->format_components_html_for_compile();

		$this->hbs->set_partials( $partials );

		//$this->hbs->set_helpers( $this->format_helpers_for_compile() );

		$this
			->compiler
			->version_id( intval($version_id) )
			->run('scss')
			->run('js-head')
			->run('js-body');

		$page = $this->get_version_preview($version_id);
		$compiled_template = $this->compile_lightncandy( $page, 'preview', 'preview', 'preview' );
		
		$html = $this->hbs->render( $compiled_template, $this->get_data_for_preview($page['page_id']) );

		return $html;
	}

	public function build( $version_id = false )
	{
		$this->hbs->set_partials( $this->format_components_html_for_compile() );

		//$this->hbs->set_helpers( $this->format_helpers_for_compile() );

		$page = $this->get_version($version_id);

		return $this->compile_lightncandy( $page );
	}

	private function compile_lightncandy( $page, $head_js = '', $css = '', $body_js = ''  )
	{
		$key = $this->get_key();

		if( $head_js != 'preview' )
		{
			$head_js = "<script type=\"text/javascript\" src=\"/runtime/$key/component.head.js\"></script>";
		}
		else
		{
			$head_js = "<script type=\"text/javascript\" src=\"/preview/js-head.min.js\"></script>";
		}

		if( $css != 'preview' )
		{
			$css = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/runtime/$key/component.css\">";
		}
		else
		{
			$css = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/preview/scss.min.css\">";
		}

		if( $body_js != 'preview' )
		{
			$body_js = "<script type=\"text/javascript\" src=\"/runtime/$key/component.body.js\"></script>";
		}
		else
		{
			$body_js = "<script type=\"text/javascript\" src=\"/preview/js-body.min.js\"></script>";
		}

		$layout = $this->get_layout( $page['layout'] );

		$this->hbs->set_layout( $layout['content'] );

		$template = '{{#>__cms_layout}}'
					.	'{{#*inline "title"}}'.$page['title'].'{{/inline}}'
					.	'{{#*inline "js"}}' . $head_js .'{{/inline}}'
					.	'{{#*inline "css"}}' . $css . '{{/inline}}'
					.	'{{#*inline "contents"}}' . $page['contents'] . '{{/inline}}'
					.	'{{#*inline "nonblocking_js"}}' . $body_js .'{{/inline}}'
					.'{{/__cms_layout}}';

		return $this->hbs->compile( $template );
	}

	public function format_components_html_for_compile()
	{
		if( empty($this->components_html) )
		{
			$components = $this->get_components();

			$return = [];
			foreach( $components as $component )
			{
				$return[$component['name']] = $component['html'];
			}

			$this->components_html = $return;
			return $return;
		}
		else
		{
			return $this->components_html;
		}
	}

	public function format_helpers_for_compile()
	{
		if( empty($this->helpers) )
		{
			$helpers_model = new helper();

			$helpers = $helpers_model->read();

			$return = [];
			foreach( $helpers as $helper )
			{
				$name = $helper['name'];
				$func = $helper['content'];

				$return[$name] = $func;
			}

			$this->helpers = $return;
		}

		return $this->helpers;
	}

	public function get_version( $id = false )
	{
		$sql = "SELECT *
				FROM deployable_pages
				WHERE version_id = :version_id";
		$params = [
			':version_id' => $id
		];

		return $this->select_row( $sql, $params );
	}

	public function get_version_preview( $id = false )
	{
		$sql = "SELECT *
				FROM previewable_pages
				WHERE version_id = :version_id";
		$params = [
			':version_id' => $id
		];

		return $this->select_row( $sql, $params );
	}

	public function get_layout( $layout_name = false )
	{
		$sql = "SELECT *
				FROM previewable_layouts
				WHERE layout_name = :layout_name";
		$params = [
			':layout_name' => $layout_name
		];

		return $this->select_row( $sql, $params );
	}
}
