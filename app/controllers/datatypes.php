<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class datatypes_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->datatype = new datatype();
	}

	public function index()
	{
		view::add_param( 'datatypes', $this->datatype->read() );
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
			$result = $this->datatype->create( $params );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect("/datatypes/update/$result");

	}

	public function update( $id )
	{
		$datatype = $this->datatype->read($id);

		view::add_param( 'datatype', $datatype );
	}

	public function do_update( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->datatype->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect($_SERVER['HTTP_REFERER']);
	}


	public function delete( $id )
	{
		$datatype = $this->datatype->read($id);
		view::add_param( 'datatype', $datatype );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->datatype->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/datatypes');
	}
}
