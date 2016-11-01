<?php

use \puffin\message as message;
use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class page_data_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __before_call()
	{
		$this->datatype = new datatype();

		$this->page = new page();
		$this->page_data = new page_data();
		$this->page_layouts = new page_layout();
		$this->page_versions = new page_version();
	}

	public function create( $id )
	{
		$page = $this->page->read($id);

		view::add_param( 'page', $page );
		view::add_param( 'datatypes', $this->datatype->read() );
	}

	public function do_create( $id )
	{
		$params = $this->post->params( $unsanitized = true );
		$result = $this->page_data->create( $params );

		if( $result )
		{
			message::add([
				'class' => 'success',
				'title' => 'Success!',
				'message' => 'This datatype has been added.'
			]);
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This datatype has not been added.'
			]);
		}

		url::redirect("/pages/update/$id/data-update/$result");
	}

	public function update( $id, $data_id )
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

	public function do_update( $id, $data_id )
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

	public function do_delete( $id, $data_id )
	{
		$result = $this->page_data->delete( $data_id );
		url::redirect($_SERVER['HTTP_REFERER']);
	}

}
