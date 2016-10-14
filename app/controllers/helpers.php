<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class helpers_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->helper = new helper();
	}

	public function index()
	{
		view::add_param( 'helpers', $this->helper->read() );
	}

	#--------------------------------------

	public function create()
	{
		#nada soul
	}

	public function do_create()
	{
		$required = ['name','author_user_id'];

		$params = $this->post->params( $unsanitized = true );

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
			$result = $this->helper->create( $params );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect("/helpers/update/$result");

	}

	#--------------------------------------

	public function update( $id )
	{
		$helper = $this->helper->read($id);

		view::add_param( 'helper', $helper );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $params['id'] == $id )
		{
			$this->helper->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	#--------------------------------------

	public function delete( $id )
	{
		$helper = $this->helper->read($id);

		view::add_param( 'helper', $helper );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->helper->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	#--------------------------------------

}