<?php

use \puffin\model\pdo as pdo;
use \puffin\directory as directory;
use \puffin\file as file;
use \puffin\controller\param as param;
use Leafo\ScssPhp\Compiler as scss_compiler;

class page_version_preview extends pdo
{
	protected $table = 'dual';

	public function get_preview( $version_id )
	{
		$sql = 'SELECT *
				FROM page_version_preview
				WHERE page_version_id = :version_id';

		$params = [
			':version_id' => $version_id
		];

		return $this->select_row( $sql, $params );
	}

	public function get_layout_scripts( $layout_id )
	{
		$sql = 'SELECT
					st.name,
					s.html
				FROM page_layout_scripts pls
					JOIN scripts s ON s.id = pls.script_id
					JOIN script_types st ON st.id = s.script_type_id
				WHERE pls.page_layout_id = :layout_id
				ORDER BY pls.load_order asc';

		$params = [
			':layout_id' => $layout_id
		];

		$tags = $this->select( $sql, $params );

		foreach( $tags as $tag )
		{
			if( !in_array($tag['name'], $this->script_tags ) )
			{
				$this->script_tags[ $tag['name'] ] = '';
			}

			$this->script_tags[ $tag['name'] ] .= $tag['html'];
		}
	}

	public function get_components_html_for_compile()
	{
		$components = $this->select( 'SELECT name, uuid, html from components' );
		$return = [];
		foreach( $components as $component )
		{
			$uuid = transformer::uuid($component['uuid']);
			$return[$component['name']] = "<div class=\"$uuid component_{$component['name']}\">{$component['html']}</div>";
		}
		return $return;
	}

	public function get_components_css_for_compile()
	{
		return $this->select( 'SELECT name, uuid, css from components' );
	}

	public function get_components_js_for_compile()
	{
		return $this->select( 'SELECT name, uuid, js from components' );
	}

	public function get_components_nonblocking_js_for_compile()
	{
		return $this->select( 'SELECT name, uuid, nonblocking_js from components' );
	}

	public function get_page_data_for_compile( $page_id )
	{
		$sql = 'SELECT
					reference_name,
					content
				FROM page_data
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

}
