<?php

use \puffin\model\pdo as pdo;
use \puffin\controller\param as param;

class page_preview extends pdo
{
	protected $table = 'dual';

	private $components = [];

	public function get_versions( $id = false )
	{
		if( !$id )
		{
			$sql = "SELECT * FROM deployable_pages";
			$params = [];
		}
		else
		{
			$sql = "SELECT *
					FROM deployable_pages
					WHERE version_id = :version_id";
			$params = [
				':version_id' => $id
			];
		}

		return $this->select( $sql, $params );
	}

	public function get_layout( $layout_name = false )
	{
		$sql = "SELECT *
				FROM deployable_layouts
				WHERE layout_name = :layout_name";
		$params = [
			':layout_name' => $layout_name
		];

		return $this->select_row( $sql, $params );
	}

	public function get_page_data( $page_id )
	{
		$sql = 'SELECT *
				FROM deployable_page_data
				WHERE page_id = :page_id';

		$params = [
			':page_id' => $page_id
		];

		$data = $this->select( $sql, $params );

		$return = [];
		foreach( $data as $datum )
		{
			$return[$datum['reference_name']] = json_decode($datum['content'], $assoc = true);
		}

		$param = new param([]);

		return [
			'Get' => $param->sanitize($_GET),
			'Post' => $param->sanitize($_POST),
			'Server' => $_SERVER,
			'Session' => $_SESSION,
			'Data' => $param->sanitize($return)
		];
	}

	public function get_components()
	{
		if( empty($this->components) )
		{
			$this->components = $this->select( 'SELECT * from deployable_components' );
		}

		return $this->components;
	}

	public function get_components_html()
	{
		$components = $this->get_components();

		$return = [];
		foreach( $components as $component )
		{
			extract($component);
			$return[$name] = $html;
		}
		return $return;
	}

	public function get_components_css()
	{
		$components = $this->get_components();

		$return = '';
		foreach( $components as $component )
		{
			extract($component);
			$return .= $css;
		}
		return $return;
	}

	public function get_components_js()
	{
		$components = $this->get_components();

		$return = '';
		foreach( $components as $component )
		{
			extract($component);
			$return .= $js;
		}
		return "<script>$return</script>";
	}

	public function get_components_nbjs()
	{
		$components = $this->get_components();

		$return = '';
		foreach( $components as $component )
		{
			extract($component);
			$return .= $nonblocking_js;
		}
		return "<script>$return</script>";
	}
}
