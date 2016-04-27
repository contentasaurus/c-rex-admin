<?php

use \puffin\view as view;

class layout extends  puffin\controller\plugin
{
	public function __init()
	{
		view::title('Puffin Framework');
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
