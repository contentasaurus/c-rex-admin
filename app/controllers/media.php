<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;
use \puffin\transformer as transformer;
use \puffin\file as file;
use \puffin\directory as directory;

class media_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->file = new file();
		$this->directory = new directory();
		$this->media = new dam_media();
		$this->tag = new dam_tag();
		$this->media_tag = new dam_media_tag();
	}

	public function index()
	{
		$params = $this->get->params( $unsanitized = false );

		$tags = [];
		if( !empty($params['tags']) )
		{
			$tags = $params['tags'];
		}

		$having = [];
		if( !empty($params['having']) )
		{
			$having = $params['having'];
		}

		view::add_param( 'selected_tags', $tags );
		view::add_param( 'tags', $this->tag->read() );
		view::add_param( 'having', $having );
		view::add_param( 'media', $this->media->get_all( $tags, $having ) );
	}

	public function create()
	{
		view::add_param( 'tags', $this->tag->read() );
	}

	public function do_create()
	{
		$params = $this->post->params( $unsanitized = true );

		$inserts = [];

		$inserts = array_merge(
			$this->media->upload_files( transformer::fixfiles( $_FILES ) ),
			$this->media->transfer_remote_files( array_filter($params['links']) )
		);

		foreach( $inserts as $insert )
		{
			$media_id = $this->media->create( $insert );

			if( isset($params['tags']) )
			{
				foreach( $params['tags'] as $tag_id )
				{
					$this->media_tag->create([
						'media_id' => $media_id,
						'tag_id' => $tag_id
					]);
				}
			}
		}

		url::redirect('/media');

	}


	public function update( $id )
	{
		view::add_param( 'media', $this->media->read($id) );
		view::add_param( 'tags', $this->tag->read() );

		$has_tags = $this->media_tag->tags_by_media_id( $id );
		$tag_array = [];

		foreach($has_tags as $rel)
		{
			$tag_array []= $rel['tag_id'];
		}

		view::add_param( 'media_tags', $tag_array );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = false );

		if( $params['media_id'] == $id )
		{
			foreach( $params['tags'] as $tag_id )
			{
				//try to insert tags, ignoring if the tag_id/media_id combo already exists.
				@$this->media_tag->create( [ 'media_id' => $params['media_id'], 'tag_id' => $tag_id ] );
			}
		}
		else
		{
			#message about can't update
		}

		url::redirect('/media');
	}


	public function delete( $id )
	{
		$media = $this->media->read($id);

		view::add_param( 'media', $media );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$media = $this->media->read($id);

			$this->file->delete( PUBLIC_PATH . $media['local_path'] );
			$this->file->delete( PUBLIC_PATH . $media['thumbnail_path'] );

			$this->media->delete( $id );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/media');
	}

}
