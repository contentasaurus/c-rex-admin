<?php

use \puffin\message as message;
use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class site_data_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->datatype = new datatype();
		$this->site_data = new site_data();
	}

	public function index()
	{
		url::redirect( '/datatypes' );
	}

	public function create()
	{
		view::add_param( 'datatypes', $this->datatype->read() );
	}

	public function do_create()
	{
		$required = ['reference_name','author_user_id'];

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
			$result = $this->site_data->create( $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This site data has not been added.'
			]);

			url::redirect("/datatypes/");
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This site data has been added.'
		]);

		url::redirect("/datatypes/site-data/update/$result");

	}

	public function update( $id )
	{
		$site_data = $this->site_data->read( $id );
		$site_data['content'] = json_encode( json_decode($site_data['content'], $assoc = true) );

		$datatype = $this->datatype->read( $site_data['datatype_id'] );
		$datatype['content'] = json_encode( json_decode($datatype['content'], $assoc = true) );

		view::add_param( 'site_data', $site_data );
		view::add_param( 'datatype', $datatype );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		if( $id == $params['id'] )
		{
			unset( $params['id'] );
		}
		else
		{
			url::redirect($_SERVER['HTTP_REFERER']);
		}

		$update = [];
		$update['author_user_id'] = $_SESSION['user']['id'];
		$update['content'] = json_encode($params);

		$result = $this->site_data->update( $id, $update );

		url::redirect($_SERVER['HTTP_REFERER']);

	}


	public function delete( $id )
	{
		$site_data = $this->site_data->read($id);
		view::add_param( 'site_data', $site_data );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->site_data->delete( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This site data has not been deleted.'
			]);

			url::redirect($_SERVER['HTTP_REFERER']);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This site data has been deleted.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
	}
}
