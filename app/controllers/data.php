<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class data_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->data = new data();
	}

	public function index()
	{
		view::add_param( 'data', $this->data->read() );
	}

	public function create()
	{

	}

	public function do_create()
	{
		$required = ['name','author_user_id'];

		$params = $this->post->params();

		#clean the array
		$params = array_filter( $params );

		$match = true;
		foreach( $required as $r )
		{
			if( !in_array($r, array_keys($params) ) )
			{
				$match = false;
				break;
			}
		}

		if( $match )
		{
			$result = $this->data->create( $params );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect("/data/update/$result");

	}

	public function update( $id )
	{
		$data = $this->data->read($id);

		view::add_param( 'data', $data );
	}

	public function do_update( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->data->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect('/data');
	}


	public function delete( $id )
	{
		$data = $this->data->read($id);
		view::add_param( 'data', $data );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->data->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/data');
	}
}
