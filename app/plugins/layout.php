<?php

use \puffin\controller as controller;
use \puffin\view as view;

class layout extends  puffin\controller\plugin
{
	public function __init()
	{
		view::title( 'C-Rex Admin - ' . ucwords(controller::$controller) );
		view::layout('master');
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
