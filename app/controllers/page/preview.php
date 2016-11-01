<?php
use \puffin\view as view;

class page_preview_controller extends puffin\controller\action
{
	public function __construct(){}

	#----------------------------------------------------------------

	public function index( $version_id = false )
	{
		view::layout('preview');
		$this->export = new deployment_export();
		view::add_param( 'html', $this->export->preview( $version_id ) );
	}

}
