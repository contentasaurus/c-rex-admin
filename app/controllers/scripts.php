<?php

use \puffin\message as message;
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
			$result = $this->script->create( $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This script has not been added.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This script has been added.'
		]);

		url::redirect('/layouts');

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
			$this->script->update( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This script has not been updated.'
			]);
			
			url::redirect($_SERVER['HTTP_REFERER']);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This script has been updated.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
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
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This script has not been deleted.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This script has been deleted.'
		]);

		url::redirect('/layouts');
	}

}
