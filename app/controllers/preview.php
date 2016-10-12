<?php
use \puffin\url as url;
use \puffin\view as view;
use \puffin\file as file;
use \puffin\directory as directory;
use \puffin\transformer as transformer;
use \Leafo\ScssPhp\Compiler as scss_compiler;

class preview_controller extends puffin\controller\action
{
	public $components = [];

	public function __construct(){}

	public function __init()
	{
		$this->export = new deployment_export();
	}

	#----------------------------------------------------------------

	public function preview( $version_id = false )
	{
		view::layout('preview');
		view::add_param( 'html', $this->export->preview( $version_id ) );
	}

}
