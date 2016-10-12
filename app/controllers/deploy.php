<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;
use \puffin\transformer as transformer;
use \puffin\dsn as dsn;

class deploy_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __before_call()
	{
		$user = new user();
		if( !$user->is_admin( $_SESSION['user']['id'] ) )
		{
			url::redirect('/');
		}
	}

	public function __init()
	{
		$this->datasource = new datasource();
	}

	public function index()
	{
		view::add_param( 'datasources', $this->datasource->read() );
	}

	#------------------------------

	public function create()
	{
	}

	public function do_create()
	{
		$params = $this->post->params();

		$this->datasource->create($params);

		url::redirect('/deploy');
	}

	#------------------------------

	public function update( $id )
	{
		view::add_param( 'datasource', $this->datasource->read( $id ) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params();

		$this->datasource->update($id, $params);

		url::redirect('/deploy');
	}

	#------------------------------

	public function delete()
	{
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		$this->datasource->delete($id);

		url::redirect('/deploy');
	}

	#------------------------------

	public function test( $id )
	{
		$db = $this->datasource->read( $id );

		$test_results = $this->do_test( $id, $db );

		view::add_param( 'dbname', $db['dbname']);
		view::add_param( 'test_results', $test_results );
	}

	public function do_test( $id, $db = false )
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

			$test_results = [
				'table_create_test' => $test->create_table(),
				'view_create_test' => $test->create_view(),
				'table_delete_test' => $test->delete_table(),
				'view_delete_test' => $test->delete_view()
			];

		}
		catch (Exception $e)
		{
			$test_results = 'Database connection error. Please check your credentials and try again.';
		}

		return $test_results;
	}


	#------------------------------
	public function build( $id )
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

		$deployment = new deployment();

		view::add_param( 'datasource', $db );
		view::add_param( 'deployments', $deployment->read() );
	}

	public function do_build()
	{
		$params = $this->post->params();

		$db = $this->datasource->read( $params['id'] );

		dsn::set('datasource_deploy', [
			'type' => $db['type'],
			'name' => $db['dbname'],
			'user' => $db['username'],
			'pass' => $db['password'],
			'addr' => $db['host'],
			'port' => $db['port'],
		]);

		if( empty($params['key']) )
		{
			$params['key'] = date('Ymdhis');
		}

		$export = new deployment_export();

		$export->set_key( $params['key'] )
			->make()
			->create_tables()
			->verify_tables()
			->alter_views();

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}

}
