<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class collections_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->collection = new collection();
	}

	public function index()
	{
		view::add_param( 'collections', $this->collection->read() );
	}

	public function create()
	{

	}

	public function do_create()
	{
		$required = ['collection_name','author_user_id'];

		$params = $this->post->params();

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
			$params['collection_index'] = 1;
			$result = $this->collection->create( $params );
			do
			{
				$params['collection_index']++;
				$result = $this->collection->create( $params );
			}
			while( !$result );
		}
		else
		{
			#TODO remove this!
			var_dump($match);
			debug( $params ); exit;
		}

		url::redirect('/collections');

	}

	public function update( $id )
	{
		$collection = $this->collection->read($id);
		$collection['collection_data'] = json_decode($collection['collection_data'], $assoc = true);

		view::add_param( 'collection', $collection );
	}

	public function do_update( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$array = array_combine( $params['collection_data_key'], $params['collection_data_value'] );

			unset($params['collection_data_key']);
			unset($params['collection_data_value']);

			$this->collection->update( $id, $params );
			$this->collection->column_create( $id, 'collection_data', $array );
		}
		else
		{
			#message about can't update
		}

		url::redirect('/collections');
	}


	public function delete( $id )
	{
		$collection = $this->collection->read($id);
		$collection['collection_data'] = json_decode($collection['collection_data'], $assoc = true);

		view::add_param( 'collection', $collection );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->collection->delete( $id, $params );
		}
		else
		{
			#message about can't delete
		}

		url::redirect('/collections');
	}

}
