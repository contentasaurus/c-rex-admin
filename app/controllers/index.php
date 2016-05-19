<?php

use \puffin\model as model;
use \puffin\view as view;

class index_controller extends puffin\controller\action
{
	public function __construct(){}

	public function index()
	{
		$user = new user();

		view::add_param( 'is_owner', $user->is_owner( $_SESSION['user']['id'] ) );
		view::add_param( 'is_editor', $user->is_editor( $_SESSION['user']['id'] ) );
		view::add_param( 'is_author', $user->is_author( $_SESSION['user']['id'] ) );
		view::add_param( 'is_disabled', $user->is_disabled( $_SESSION['user']['id'] ) );
	}

}
