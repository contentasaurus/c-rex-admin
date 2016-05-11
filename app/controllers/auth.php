<?php

use puffin\view as view;
use puffin\url as url;
use puffin\message as message;
use puffin\password as password;

class auth_controller extends puffin\controller\action
{
	public function __init()
	{
		$this->user = new user();
	}

	public function __before_call()
	{
		view::layout('login');
	}

	public function index()
	{
		url::redirect('/auth/login/');
	}

	public function login()
	{
		#show form
	}

	public function process_login()
	{
		$user = $this->user->login( $this->post->param('email'), $this->post->param('password') );

		if( !empty($user) )
		{
			$_SESSION['user'] = $user;

			// if( $user['force_password_reset'] == 1 )
			// {
			// 	$_SESSION['FORCED_RESET'] = 1;
			// 	url::redirect('/auth/change-password/');
			// }

			url::redirect('/');
		}
		else
		{
			message::add( array( 'class' => 'error', 'message' => 'Bad email or password' ) );
			url::redirect('/auth/login/');
		}
	}

	public function logout()
	{
		session_destroy();
		url::redirect('/auth/login/');
	}

	public function change_password()
	{
		#change password form
	}

	public function process_change_password()
	{
		$this->user->change_password( $_SESSION['user']['email'], $this->post('password'), $this->post('confirm_password') );
	}

	public function password_reset()
	{
		#password reset form
	}

	public function process_password_reset()
	{
		$password = $this->user->reset_password( $this->post('email') );
		message::add( array( 'class' => 'info', 'message' => "$password" ) );
		url::redirect('/auth/reset-confirm/');
	}

}
