<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;
use \puffin\transformer as transformer;
use \puffin\dsn as dsn;

class build_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->datasource = new datasource();
	}

	public function index()
	{
		view::add_param( 'datasources', $this->datasource->read() );
	}

	#------------------------------

	public function datasource_create()
	{
	}

	public function do_datasource_create()
	{
		$params = $this->post->params();

		$this->datasource->create($params);

		url::redirect('/build');
	}

	#------------------------------

	public function datasource_update()
	{
	}

	public function do_datasource_update()
	{
	}

	#------------------------------

	public function datasource_delete()
	{
	}

	public function datasource_test( $id )
	{
		$db = $this->datasource->read( $id );

		try
		{
			dsn::set('datasource_test', [
				'type' => $db['db_type'],
				'name' => $db['db_name'],
				'user' => $db['db_user'],
				'pass' => $db['db_password'],
				'addr' => $db['db_address']
			]);

			$test = new datasource_test();

			$tables = $test->show_tables();

			$test_results = [];
			foreach($tables as $table)
			{
				foreach($table as $header => $tablename)
				{
					$test_results[$header] []= $tablename;
				}
			}


		}
		catch (Exception $e)
		{
			$test_results = 'Database connection error. Please check your credentials and try again.';
		}

		try
		{
			$test = new datasource_test();

			$permissions = $test->show_schema_privileges( $db['db_user'], $db['db_name'] );
		}
		catch (Exception $e)
		{
			$test_results = 'Schema permissions unattainable. Please check your connection and try again.';
		}

		view::add_param( 'test_results', $test_results );
		view::add_param( 'permissions', $permissions );
	}

	#------------------------------

	private function export_scripts()
	{
	}

	private function export_layouts()
	{
	}

	private function export_data()
	{
	}

	private function export_pages()
	{
	}

	private function export_components()
	{
	}

	private function export_media()
	{
	}

}
