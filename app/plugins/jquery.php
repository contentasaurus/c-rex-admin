<?php

use \puffin\view as view;

class jquery extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', $nonblocking = false);
		view::add_js('http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', $nonblocking = true);
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
