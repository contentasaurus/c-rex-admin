<?php

use \puffin\message as message;
use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class pages_controller extends puffin\controller\action
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

	public function index()
	{
		$pages = $this->page->read();

		view::add_param( 'pages', $this->page->read() );
		view::add_param( 'treetable', $this->page->get_permalink_dictionary() );
	}

	public function create()
	{
		view::add_param( 'page_layouts', $this->page_layouts->read() );
	}

	public function do_create()
	{
		$required = ['name','author_user_id','permalink'];

		$params = $this->post->params( $unsanitized = false );

		$quick_add = false;
		if( isset($params['quick_add']) )
		{
			$quick_add = true;
			unset($params['quick_add']);
		}

		#clean the array
		$params = array_filter( $params );

		$match = true;
		foreach( $required as $r )
		{
			if( !in_array($r, array_keys($params) ) )
			{
				$match = false;
				break;
			}
		}

		if( $match )
		{
			$result = $this->page->create( $params );

			message::add([
				'class' => 'success',
				'title' => 'Success!',
				'message' => 'This page has been added.'
			]);

			if( $quick_add )
			{
				url::redirect($_SERVER['HTTP_REFERER']);
			}

			url::redirect("/pages/update/$result");
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This page has not been added.'
			]);
		}
	}

	public function update( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'page_versions', $this->page_versions->read_by_page_id($id) );
		view::add_param( 'page_data', $this->page_data->read_by_page_id( $id ) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );


		if( $params['id'] == $id )
		{
			$this->page->update( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This page has not been updated.'
			]);

			url::redirect($_SERVER['HTTP_REFERER']);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This page has been updated.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function set_publish( $id, $state )
	{
		$update = [
			'is_publishable' => $state
		];

		$this->page->update( $id, $update );

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}

	public function delete( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->page->delete( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This page has not been deleted.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This page has been deleted.'
		]);

		url::redirect('/pages');
	}

	##################################################

	public function do_version_create( $id )
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

	public function version_update( $id, $version_id )
	{
		view::add_param( 'page', $this->page->read($id) );
		view::add_param( 'page_layouts', $this->page_layouts->read() );
		view::add_param( 'page_version', $this->page_versions->read($version_id) );
	}

	public function do_version_update( $id, $version_id )
	{
		$params = $this->post->params( $unsanitized = true );

		$result = $this->page_versions->update( $version_id, $params );

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_version_split_update( $page_id  )
	{
		$params = $this->post->params( $unsanitized = true );

		foreach( $params['version'] as $id => $update )
		{
			$this->page_versions->update( $id, $update );
		}

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_version_copy( $id, $version_id )
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

	public function do_version_delete( $id, $version_id )
	{
		$result = $this->page_versions->delete( $version_id );
		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function version_set_publish( $id, $version_id, $state )
	{
		$update = [
			'is_publishable' => $state
		];

		$this->page_versions->update( $version_id, $update );

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}

	##################################################

	public function data_create( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'datatypes', $this->datatype->read() );
	}

	public function do_data_create( $id )
	{
		$params = $this->post->params( $unsanitized = true );
		$result = $this->page_data->create( $params );
		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function data_update( $id, $data_id )
	{
		$page = $this->page->read( $id );

		$page_data = $this->page_data->read( $data_id );
		$page_data['content'] = json_encode( json_decode($page_data['content'], $assoc = true) );

		$datatype = $this->datatype->read( $page_data['datatype_id'] );
		$datatype['content'] = json_encode( json_decode($datatype['content'], $assoc = true) );

		view::add_param( 'page', $page);
		view::add_param( 'page_data', $page_data );
		view::add_param( 'datatype', $datatype );
	}

	public function do_data_update( $id, $data_id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $data_id == $params['id'] )
		{
			unset( $params['id'] );
		}
		else
		{
			url::redirect($_SERVER['HTTP_REFERER']);
		}

		$update = [];
		$update['author_user_id'] = $_SESSION['user']['id'];
		$update['content'] = json_encode($params);

		$result = $this->page_data->update( $data_id, $update );

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_data_delete( $id, $data_id )
	{
		$result = $this->page_data->delete( $data_id );
		url::redirect($_SERVER['HTTP_REFERER']);
	}

}
