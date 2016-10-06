<?php

use \puffin\view as view;

class compiled_js extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_js("/dist/js/high-dom/admin.min.js", $nonblocking = false);
		view::add_js("/dist/js/low-dom/admin.min.js", $nonblocking = true);
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
