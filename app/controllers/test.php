<?php

use \puffin\model as model;
use \puffin\view as view;
use \feather as feather;

class test_controller extends puffin\controller\action
{
	public function __construct()
	{

	}

	public function index()
	{
		$test = new feather\server();
		$results = $test->go();
		view::add_param( 'test_results', $results );
	}

}
