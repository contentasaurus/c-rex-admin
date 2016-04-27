<?php

use \puffin\view as view;

class googlefont extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_css('http://fonts.googleapis.com/css?family=Montserrat:400,700');
    	view::add_css('http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
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
