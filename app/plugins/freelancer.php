<?php

use \puffin\view as view;

class freelancer extends  puffin\controller\plugin
{
	public function __init()
	{
		view::add_css('/css/freelancer.css');

		view::add_js('/js/classie.js', $nonblocking=true);
		view::add_js('/js/cbpAnimatedHeader.js', $nonblocking=true);
		view::add_js('/js/freelancer.js', $nonblocking=true);


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
