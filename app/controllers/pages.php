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

			url::redirect('/pages');
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This page has been deleted.'
		]);

		url::redirect('/pages');
	}

}
