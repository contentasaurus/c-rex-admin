<?php

use \puffin\transformer as transformer;
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
		$params = $this->post->params( $unsanitized = true );

		$params['author'] = $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];

		$params['slug'] = $this->blog->check_slug_for_unique( transformer::safeslug($params['title']) );

		if( $result = $this->blog->create( $params ) )
		{
			message::add([
				'class' => 'success',
				'title' => 'Success!',
				'message' => 'This blog post has been added.'
			]);

			url::redirect("/blog/update/$result");
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This blog post has not been added.'
			]);

			url::redirect("/blog/create");
		}

	}

	#---------------------------

	public function update( $id )
	{
		view::add_param( 'blog', $this->blog->read($id) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		$params['slug'] = $this->blog->recheck_slug_for_unique( $id, $params['slug'] );

		unset($params['files']);

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

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->blog->delete( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This blog post has not been deleted.'
			]);

			url::redirect($_SERVER['HTTP_REFERER']);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This blog post has been deleted.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

}
