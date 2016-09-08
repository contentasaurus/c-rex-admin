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
		view::add_param( 'pages', $this->page->read() );
	}

	public function create()
	{
		view::add_param( 'page_layouts', $this->page_layouts->read() );
		view::add_param( 'page_statuses', $this->page_status->read() );
	}

	public function do_create()
	{
		$required = ['page_name','author_user_id','permalink','page_status_id'];

		$params = $this->post->params( $unsanitized = true );

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
		view::add_param( 'page_layouts', $this->page_layouts->read() );
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

	public function publish( $id )
	{
		$update = [
			'is_publishable' => 1
		];

		$this->page->update( $id, $update );

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}

	public function unpublish( $id )
	{
		$update = [
			'is_publishable' => 0
		];

		$this->page->update( $id, $update );

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}



	public function update_status( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'page_logs', $this->page_log->read_by_page_id($id) );
		view::add_param( 'page_statuses', $this->page_status->read() );
	}

	public function do_update_status( $id )
	{
		$params = $this->post->params();

		$orignal_record = $this->page->read($id);

		#page status history
		$record = [
			'page_id' => $id,
			'prev_page_status_id' => $orignal_record['page_status_id'],
			'new_page_status_id' => $params['page_status_id'],
			'user_id' => $_SESSION['user']['id'],
			'comment' => $params['comment']
		];

		$this->page_log->create($record);

		$updates = [
			'page_status_id' => $params['page_status_id']
		];

		$this->page->update( $id, $updates );

		url::redirect("/pages/update/$id/status");
	}

	public function update_version( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'page_versions', $this->page_versions->read_by_page_id($id) );
	}

	public function do_update_version( $id )
	{
		$page = $this->page->read($id);

		$create = [
			'page_id' => $page['id'],
			'author_user_id' => $_SESSION['user']['id'],
			'page_status_id' => $page['page_status_id'],
			'page_layout_id' => $page['page_layout_id'],
			'page_name' => $page['page_name'],
			'page_content' => $page['page_content']
		];

		$this->page_versions->create($create);

		url::redirect("/pages/update/$id/versions");
	}

	public function update_version_update( $id, $version_id )
	{
		view::add_param( 'page', $this->page->read($id) );
		view::add_param( 'page_layouts', $this->page_layouts->read() );
		view::add_param( 'page_version', $this->page_versions->read($version_id) );
	}

	public function update_version_promote( $id, $version_id )
	{
		view::add_param( 'page', $this->page->read($id) );
		view::add_param( 'page_version', $this->page_versions->read($version_id) );
	}

	public function update_version_delete( $id, $version_id )
	{
		view::add_param( 'page', $this->page->read($id) );
		view::add_param( 'page_version', $this->page_versions->read($version_id) );
	}

	public function update_history( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'page_history', $this->page_history->read_by_page_id($id) );
	}


	public function update_data( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'datatypes', $this->datatype->read() );
		view::add_param( 'page_data', $this->page_data->read_by_page_id( $id ) );
	}

	public function do_update_data( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		$result = $this->page_data->create( $params );

		url::redirect($_SERVER['HTTP_REFERER']);
	}


	public function update_data_update( $id, $data_id )
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

	public function do_update_data_update( $id, $data_id )
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

}
