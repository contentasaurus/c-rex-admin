<?php

use \puffin\view as view;

class fonts extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
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
