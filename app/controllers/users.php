<?php

use puffin\view as view;
use puffin\url as url;
use puffin\message as message;
use puffin\password as password;
use puffin\controller as controller;

class users_controller extends puffin\controller\action
{
	public function __init()
	{
		$this->user = new user();
		$this->role = new role();
	}

	public function __before_call()
	{
		if( controller::$action != 'profile' )
		{
			if( !$this->user->is_admin( $_SESSION['user']['id'] ) )
			{
				url::redirect('/users/no-access');
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
		view::add_param( 'roles', $this->role->read() );
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
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect('/users');

	}

	public function update( $id )
	{
		view::add_param( 'roles', $this->role->read() );
		view::add_param( 'user', $this->user->read( $id ) );
	}

	public function do_update( $id )
	{
		$params = $this->put->params();
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
