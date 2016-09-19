<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class index_controller extends puffin\controller\action
{
	public function __construct(){}

	public function index()
	{
		url::redirect('/pages');
	}

	public function about()
	{

	}

}
