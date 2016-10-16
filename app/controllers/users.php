<?php

use puffin\url as url;
use puffin\view as view;
use puffin\message as message;
use puffin\password as password;
use puffin\controller as controller;

class users_controller extends puffin\controller\action
{
	public function __init()
	{
		$this->user = new user();
	}

	public function __before_call()
	{
		if( controller::$action != 'profile' )
		{
			if( !permissions::is_admin() )
			{
				url::redirect('/');
			}
		}
	}

	public function no_access()
	{

	}

	public function index()
	{
		view::add_param( 'users', $this->user->read() );
	}

	public function profile(  $id = false  )
	{
		if( empty($id) )
		{
			$id = $_SESSION['user']['id'];
		}

		view::add_param( 'user', $this->user->read( $id ) );
	}

	public function create()
	{
	}

	public function do_create()
	{
		$required = ['role_id', 'first_name', 'last_name', 'email', 'password'];
		$password = new password();
		$params = $this->post->params();

		if( $params['password'] == $params['confirm_password'] )
		{
			$params['password'] = $password->make( $params['password'] );
			 unset($params['confirm_password']);
		}

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
			$this->user->create( $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This user has not been added.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This user has been added.'
		]);

		url::redirect('/users');

	}

	public function update( $id )
	{
		view::add_param( 'user', $this->user->read( $id ) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params();
		$this->user->update( $params['id'], $params );
	}

	public function disable( $id )
	{
		view::add_param( 'user', $this->user->read( $id ) );
	}

	public function do_disable( $id )
	{
		$params = $this->post->params();
		if( $id == $params['id'] )
		{
			$this->user->update( $params['id'], ['is_active' => 0] );
		}
		url::redirect('/users');
		exit;
	}

	public function enable( $id )
	{
		view::add_param( 'user', $this->user->read( $id ) );
	}

	public function do_enable( $id )
	{
		$params = $this->post->params();
		if( $id == $params['id'] )
		{
			$this->user->update( $params['id'], ['is_active' => 1] );
		}
		url::redirect('/users');
		exit;
	}
}
