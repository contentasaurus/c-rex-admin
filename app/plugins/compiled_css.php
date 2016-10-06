<?php

use \puffin\view as view;

class compiled_css extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_css("/dist/css/admin.min.css");
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
