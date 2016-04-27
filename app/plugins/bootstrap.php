<?php

use \puffin\view as view;

class bootstrap extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_css('/css/bootstrap.min.css');
		view::add_js('/js/bootstrap.min.js', $nonblocking = true);
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
