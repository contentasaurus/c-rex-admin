<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;
use \puffin\transformer as transformer;
use \puffin\dsn as dsn;

class deploy_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->deployment = new deployment();
		$this->datasource = new datasource();
	}

	public function index()
	{
		view::add_param( 'deployments', $this->deployment->read() );
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

		url::redirect('/deploy');
	}

	#------------------------------

	public function datasource_update( $id )
	{
		view::add_param( 'datasource', $this->datasource->read( $id ) );
	}

	public function do_datasource_update( $id )
	{
		$params = $this->post->params();

		$this->datasource->update($id, $params);

		url::redirect('/deploy');
	}

	#------------------------------

	public function datasource_delete()
	{
	}

	public function do_datasource_delete( $id )
	{
		$params = $this->post->params();

		$this->datasource->delete($id);

		url::redirect('/deploy');
	}

	#------------------------------

	public function datasource_test( $id )
	{
		$db = $this->datasource->read( $id );

		$test_results = $this->do_datasource_test( $id, $db );

		view::add_param( 'dbname', $db['dbname']);
		view::add_param( 'test_results', $test_results );
	}

	public function do_datasource_test( $id, $db = false )
	{
		if( $db == false )
		{
			$db = $this->datasource->read( $id );
		}

		try
		{
			dsn::set('datasource_test', [
				'type' => $db['type'],
				'name' => $db['dbname'],
				'user' => $db['username'],
				'pass' => $db['password'],
				'addr' => $db['host'],
				'port' => $db['port'],
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

		return $test_results;
	}


	#------------------------------

	public function datasource_build( $id )
	{
		$db = $this->datasource->read( $id );

		dsn::set('datasource_deploy', [
			'type' => $db['type'],
			'name' => $db['dbname'],
			'user' => $db['username'],
			'pass' => $db['password'],
			'addr' => $db['host'],
			'port' => $db['port'],
		]);

		$export = [];
		$deploy_key = date('Ymdhis');

		$this->page = new page();
		$export["pages_$deploy_key"] = $this->page->build_runtime();

		$this->page_layout = new page_layout();
		$export["page_layouts_$deploy_key"] = $this->page_layout->read();

		debug($export); exit;
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
