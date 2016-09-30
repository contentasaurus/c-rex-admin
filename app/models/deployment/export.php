<?php

use \puffin\model\pdo as pdo;

class deployment_export extends pdo
{
	protected $table = '';
	protected $connection = 'datasource_deploy';

	protected $key = '';
	protected $export = [];
	protected $verification = 'false';

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

		$this->connection = 'default';

		$this->export[ $this->get_key() ]['pages'] = $this->get_pages();
		$this->export[ $this->get_key() ]['page_data'] = $this->get_page_data();
		$this->export[ $this->get_key() ]['components'] = $this->get_components();

		$this->connection = 'datasource_deploy';

		return $this;
	}

	public function get_pages()
	{
		$pages = $this->select( 'SELECT * from deployable_pages' );

		$return = [];
		foreach( $pages as $page )
		{
			$page['html'] = $this->compile_lightncandy( $page );
			$return []= $page;
		}

		return $return;
	}

	public function get_page_data()
	{
		return $this->select( 'SELECT * from deployable_page_data' );
	}

	public function get_components()
	{
		return $this->select( 'SELECT * from deployable_components' );
	}

	public function get_components_for_compile()
	{
		$components = $this->select( 'SELECT name, html from deployable_components' );
		$return = [];
		foreach( $components as $component )
		{
			$return[$component['name']] = $component['html'];
		}
		return $return;
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

	public function get_page_data_for_compile( $page_name )
	{
		$sql = 'SELECT *
				FROM deployable_page_data
				WHERE page = :page';

		$params = [
			':page'=>$page_name
		];

		$data = $this->select( $sql, $params );

		$return = [];
		foreach( $data as $datum )
		{
			$return[$datum['reference_name']] = json_decode($datum['content'], $assoc = true);
		}

		return [
			'Get' => $_GET,
			'Post' => $_POST,
			'Server' => $_SERVER,
			'Session' => $_SESSION,
			'Data' => $return
		];
	}

	public function compile_lightncandy( $page )
	{
		$hbs = new handlebars();

		$hbs->set_partials( $this->get_components_for_compile() );

		$hbs->set_layout( $this->get_layout_for_compile( $page['layout'] ) );

		$template = '{{#>__cms_layout}}'
					.	'{{#*inline "title"}}'.$page['title'].'{{/inline}}'
					.	'{{#*inline "contents"}}' . $page['contents'] . '{{/inline}}'
					.'{{/__cms_layout}}';

		$php = $hbs->compile( $template );

		return $hbs->render( $php, $this->get_page_data_for_compile($page['page']) );
	}

	public function create_tables()
	{
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

		return $this;
	}

	public function verify_tables()
	{
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

		return $this;
	}

	public function alter_views()
	{
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

			$this->table = '__recent_deployments';

			$this->execute("UPDATE {$this->table} SET is_current = 0", [] );

			$this->create([
				'deployment_key' => $this->get_key(),
				'deployed_by' => "{$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']}",
				'is_current' => 1
			]);
		}

		return $this;
	}
}
