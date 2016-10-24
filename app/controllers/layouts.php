<?php

use \puffin\message as message;
use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;

class layouts_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->page_layout = new page_layout();
		$this->script = new script();
		$this->script_type = new script_type();
		$this->page_layout_script = new page_layout_script();
	}

	public function index()
	{
		view::add_param( 'layouts', $this->page_layout->read() );

		$scripts = $this->script->read();
		$script_types = $this->script_type->read();

		foreach ($scripts as $key => $script) 
		{
			foreach ($script_types as $script_type) 
			{
				if($script['script_type_id'] == $script_type['id'])
				{
					$scripts[$key]['type'] = $script_type['name'];
				}
			}
		}

		view::add_param( 'scripts', $scripts );
	}

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
			$result = $this->page_layout->create( $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This layout has not been added.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This layout has been added.'
		]);

		url::redirect("/layouts/update/$result");

	}

	public function update( $id )
	{
		view::add_param( 'layout', $this->page_layout->read( $id ) );
	}

	public function do_update( $id )
	{
		$params = $this->post->params( $unsanitized = true );
		$this->page_layout->update( $id, $params );

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This layout has been updated.'
		]);

		url::redirect($_SERVER['HTTP_REFERER']);
	}

	public function scripts( $id )
	{
		view::add_param( 'layout', $this->page_layout->read( $id ) );
		view::add_param( 'scripts', $this->script->get_all_groups() );
		view::add_param( 'layout_scripts', $this->page_layout_script->get_layout_scripts( $id ) );
		view::add_param( 'layout_script_ids', $this->page_layout_script->get_layout_script_ids( $id ) );
	}

	public function do_scripts( $id )
	{
		$params = $this->post->params( $unsanitized = true );

		switch( $params['action'] )
		{
			case 'script_order':
				$this->update_scripts_order( $params );
				break;

			case 'script_add':
				$this->add_scripts_order( $params );
				break;
		}
	}


	public function add_scripts_order( $params )
	{
		$records = [];

		$page_layout_id = $params['page_layout_id'];

		foreach( $params['page_script_ids'] as $page_script_id )
		{
			$records []= [
				'page_layout_id' => $page_layout_id,
				'script_id' => $page_script_id,
				'load_order' => '0'
			];
		}

		foreach( $records as $record )
		{
			$this->page_layout_script->create( $record );
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This layout has been updated.'
		]);

		url::redirect("/layouts/update/$page_layout_id/scripts");
	}

	public function update_scripts_order( $params )
	{
		$records = [];

		$page_layout_id = $params['page_layout_id'];

		foreach( $params['script'] as $script_category )
		{
			for( $i=0; $i < count($script_category); $i++ )
			{
				$records []= [
					'page_layout_id' => $page_layout_id,
					'script_id' => $script_category[$i],
					'load_order' => $i + 1
				];
			}
		}

		$this->page_layout_script->recreate( $page_layout_id, $records );


		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This layout has been updated.'
		]);

		url::redirect("/layouts/update/$page_layout_id/scripts");


	}

	public function delete( $id )
	{
		$layouts = $this->page_layout->read($id);

		view::add_param( 'layout', $layouts );
	}

	public function do_delete( $id )
	{
		$params = $this->post->params();

		if( $params['id'] == $id )
		{
			$this->page_layout->delete( $id, $params );
		}
		else
		{
			message::add([
				'class' => 'danger',
				'title' => 'Failure!',
				'message' => 'This layout has not been deleted.'
			]);
		}

		message::add([
			'class' => 'success',
			'title' => 'Success!',
			'message' => 'This layout has been deleted.'
		]);

		url::redirect('/layouts');
	}

}
