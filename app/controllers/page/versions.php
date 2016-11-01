<?php

use \puffin\message as message;
use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class page_versions_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __before_call()
	{
		$this->datatype = new datatype();

		$this->page = new page();
		$this->page_data = new page_data();
		$this->page_layouts = new page_layout();
		$this->page_versions = new page_version();
	}

	public function do_create( $id )
	{
		$create = [
			'page_id' => $id,
			'author_user_id' => $_SESSION['user']['id'],
			'page_layout_id' => NULL,
			'title' => 'New Page Version',
			'comments' => 'New Page Version',
			'contents' => ''
		];

		$this->page_versions->create($create);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function update( $id, $version_id )
	{
		view::add_param( 'page', $this->page->read($id) );
		view::add_param( 'page_layouts', $this->page_layouts->read() );
		view::add_param( 'page_version', $this->page_versions->read($version_id) );
	}

	public function do_update( $id, $version_id )
	{
		$params = $this->post->params( $unsanitized = true );

		$result = $this->page_versions->update( $version_id, $params );

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_split_update( $page_id  )
	{
		$params = $this->post->params( $unsanitized = true );

		foreach( $params['version'] as $id => $update )
		{
			$this->page_versions->update( $id, $update );
		}

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_copy( $id, $version_id )
	{
		$version = $this->page_versions->read( $version_id );

		$create = [
			'page_id' => $version['page_id'],
			'author_user_id' => $_SESSION['user']['id'],
			'page_layout_id' => $version['page_layout_id'],
			'title' => $version['title'],
			'comments' => $version['comments'],
			'contents' => $version['contents']
		];

		$this->page_versions->create($create);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_delete( $id, $version_id )
	{
		$result = $this->page_versions->delete( $version_id );
		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function set_publish( $id, $version_id, $state )
	{
		$update = [
			'is_publishable' => $state
		];

		$this->page_versions->update( $version_id, $update );

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}
}
