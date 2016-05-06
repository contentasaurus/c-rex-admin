<?php

use \puffin\controller as controller;
use \puffin\url as url;

class forceauth extends  puffin\controller\plugin
{
	public function __init()
	{
		if( empty($_SESSION['user']) && controller::$controller != 'auth' )
		{
			url::redirect('/auth/login');
		}
		return false;
	}
	public function __before_call()
	{
		return false;
	}
	public function __after_call()
	{
		return false;
	}
}
