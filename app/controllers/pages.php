<?php

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
		$this->page_log = new page_log();
		$this->page_data = new page_data();
		$this->page_status = new page_status();
		$this->page_history = new page_history();
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
		view::add_param( 'page_statuses', $this->page_status->read() );
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
			if( $quick_add )
			{
				url::redirect($_SERVER['HTTP_REFERER']);
			}
			url::redirect("/pages/update/$result");
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect('/pages');

	}

	public function update( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'page_versions', $this->page_versions->read_by_page_id($id) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		#page history
		$orignal_page = $this->page->read($id);
		$orignal_page['page_id'] = $orignal_page['id'];
		unset($orignal_page['id']);

		$this->page_history->create($orignal_page);


		if( $params['id'] == $id )
		{
			$this->page->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect('/pages');
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
			#message about can't delete
		}

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

	public function do_version_copy( $id )
	{
		$version = $this->page_versions->read( $id );

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

	public function data_index( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'datatypes', $this->datatype->read() );
		view::add_param( 'page_data', $this->page_data->read_by_page_id( $id ) );
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
		$page_data['content'] = json_decode($page_data['content'], $assoc = true);

		$datatype = $this->datatype->read( $page_data['datatype_id'] );
		$datatype['content'] = json_decode($datatype['content'], $assoc = true);

		view::add_param( 'page', $page);
		view::add_param( 'page_data', $page_data );
		view::add_param( 'datatype', $datatype );
	}

	public function do_data_update( $id, $data_id )
	{
		$params = $this->post->params( $unsanitized = true );

		$datatype = $this->datatype->read( $params['datatype_id'] );
		$datatype['content'] = json_decode($datatype['content'], $assoc = true);

		$repeaters = [];
		foreach( $datatype['content'] as $field => $attributes )
		{
			if( $attributes['type'] == 'repeater' )
			{
				$repeaters []= $field;
			}
		}

		unset($params['datatype_id']);

		#clean up the repeaters' mess
		$new_content = [];
		foreach( $params['content'] as $key => $values )
		{
			if( in_array($key, $repeaters) )
			{
				foreach( $params['content'][$key] as $k => $value )
				{
					foreach( $value as $index => $v )
					{
						$new_content[$key][$index][$k] = $v;
					}
				}
			}
			else
			{
				$new_content[$key] = $values;
			}
		}

		$params['content'] = $new_content;

		$params['content'] = json_encode($params['content']);

		$result = $this->page_data->update( $data_id, $params );

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_data_delete( $id, $data_id )
	{
		$result = $this->page_data->delete( $data_id );
		url::redirect($_SERVER['HTTP_REFERER']);
	}

}
