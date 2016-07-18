<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class articles_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __before_call()
	{
		$this->article = new article();
		$this->article_type = new article_type();
	}

	public function index()
	{
		view::add_param( 'articles', $this->article->read() );
	}

	public function create()
	{
		view::add_param( 'article_types', $this->article_type->read() );
	}

	public function do_create()
	{
		$required = ['title','author_user_id','permalink','article_type_id'];

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
			$result = $this->article->create( $params );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect("/articles/update/$result");

	}

	public function update( $id )
	{
		view::add_param( 'article', $this->article->read($id) );
		view::add_param( 'article_types', $this->article_type->read() );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $params['id'] == $id )
		{
			$this->article->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect('/articles');
	}


	public function delete( $id )
	{
		view::add_param( 'page', $this->article->read($id) );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->article->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/articles');
	}

}
