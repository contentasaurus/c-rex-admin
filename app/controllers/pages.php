<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class pages_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __before_call()
	{
		$this->page = new page();
		$this->page_log = new page_log();
		$this->page_status = new page_status();
		$this->page_type = new page_type();
		$this->page_history = new page_history();
	}

	public function index()
	{
		view::add_param( 'pages', $this->page->read() );
	}

	public function create()
	{
		view::add_param( 'page_statuses', $this->page_status->read() );
		view::add_param( 'page_types', $this->page_type->read() );
	}

	public function do_create()
	{
		$required = ['page_name','author_user_id','permalink','page_type_id','page_status_id'];

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
		view::add_param( 'page_logs', $this->page_log->read() );
		view::add_param( 'page_statuses', $this->page_status->read() );
		view::add_param( 'page_history', $this->page_history->read() );
		view::add_param( 'page_types', $this->page_type->read() );
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
			#message about can't update
		}

		url::redirect('/pages');
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
