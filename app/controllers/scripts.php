<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class scripts_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->script_type = new script_type();
		$this->script = new script();
	}

	public function index()
	{
		view::add_param( 'scripts', $this->script->read() );
	}

	public function create()
	{
		view::add_param( 'script_types', $this->script_type->read() );
	}

	public function do_create()
	{
		$required = ['name','html'];

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
			$result = $this->page_script->create( $params );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect('/scripts');

	}

	public function update( $id )
	{
		view::add_param( 'script_types', $this->script_type->read() );
		view::add_param( 'script', $this->script->read($id) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $params['id'] == $id )
		{
			$this->page_script->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect('/scripts');
	}


	public function delete( $id )
	{
		$script = $this->script->read($id);

		view::add_param( 'script', $script );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->script->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/scripts');
	}

}
