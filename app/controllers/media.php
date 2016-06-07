<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class media_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->media = new dam_media();
		$this->tag = new dam_tag();
	}

	public function index()
	{
		view::add_param( 'media', $this->media->read() );
	}

	public function create()
	{
		view::add_param( 'tags', $this->tag->read() );
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
			$result = $this->block->create( $params );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect('/blocks');

	}

	public function update( $id )
	{
		$block = $this->block->read($id);

		view::add_param( 'block', $block );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $params['id'] == $id )
		{
			$this->block->update( $id, $params );
		}
		else
		{
			#message about can't update
		}

		url::redirect('/blocks');
	}


	public function delete( $id )
	{
		$block = $this->block->read($id);

		view::add_param( 'block', $block );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->block->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/blocks');
	}

}
