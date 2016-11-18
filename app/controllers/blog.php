<?php

use \puffin\message as message;
use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class blog_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->blog = new blog();
	}

	public function index()
	{
		view::add_param( 'blogs', $this->blog->read() );
	}

	#---------------------------

	public function create()
	{
		#nada soul
	}

	public function do_create()
	{
		$required = ['name','author_user_id'];

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
			$result = $this->component->create( $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This component has not been added.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This component has been added.'
		]);

		url::redirect("/components/update/$result");

	}

	#---------------------------

	public function update( $id )
	{
		view::add_param( 'blog', $this->blog->read($id) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $params['id'] == $id )
		{
			$this->blog->update( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This blog post has not been updated.'
			]);

		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This blog post has been updated.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	#---------------------------

	public function set_publish( $id, $state )
	{
		$update = [
			'is_publishable' => $state
		];

		$this->blog->update( $id, $update );

		url::redirect( $_SERVER['HTTP_REFERER'] );
	}

	#---------------------------

	public function delete( $id )
	{
		$component = $this->component->read($id);

		view::add_param( 'component', $component );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->component->delete( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This component has not been deleted.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This component has been deleted.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

}
