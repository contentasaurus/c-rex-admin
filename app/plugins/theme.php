<?php

use \puffin\view as view;

class theme extends  puffin\controller\plugin
{
	public function __init()
	{
		// view::add_css('/theme/css/admin.css');

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
