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

		if( !empty($user) && $user != '-1' )
		{
			$_SESSION['user'] = $user;

			url::redirect('/');
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'Bad email or password.'
			]);

			url::redirect('/auth/login/');
		}
	}

	public function logout()
	{
		session_destroy();
		url::redirect('/auth/login/');
	}

	public function force_change_password(){}

	public function do_force_change_password()
	{
		$this->user->change_password( $_SESSION['user']['email'], $this->post('password'), $this->post('confirm_password') );
	}

	public function password_reset(){}

	public function process_password_reset()
	{
		$email = $this->post->param('email');

		#$password = $this->user->reset_password( $email );

		$this->user->email_password_reset_confirmation( $email );

		url::redirect('/auth/password-reset-sent/');
	}

	public function password_reset_sent(){}

	public function reset_confirm( $token )
	{
		$user = $this->user->get_by_reset_token( $token );

		if( !$user )
		{
			url::redirect('/auth/reset-failure');
		}
	}

	public function do_password_reset( $token )
	{
		$params = $this->post->params();

		$user = $this->user->get_by_reset_token( $token );

		$success = $this->user->change_password_by_token( $token, $params['password'], $params['password_confirm'] );

		if( $success )
		{
			url::redirect('/auth/reset-complete');
		}
		else
		{
			url::redirect('/auth/reset-failure');
		}
	}

	public function reset_failure(){}
	public function reset_complete(){}

}
