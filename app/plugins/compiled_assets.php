<?php

use \puffin\view as view;

class compiled_assets extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_css("/dist/css/admin.min.css");
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
