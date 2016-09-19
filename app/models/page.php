<?php

use \puffin\model\pdo as pdo;

class page extends pdo
{
	protected $table = 'pages';

	public function read( $id = false )
	{
		$where = '';
		$params = [];

		if( !empty($id) )
		{
			$where .= ' WHERE p.id = :id';
			$params[':id'] = $id;
		}

		$sql = "SELECT
					p.*,
					count(pv.id) AS num_versions,
					group_concat(pv.percentage) AS split
				FROM pages p
					LEFT JOIN page_versions pv ON pv.page_id = p.id and pv.is_publishable = 1
				$where
				GROUP BY p.id
				ORDER BY p.permalink";

		if( !empty($params) )
		{
			return $this->select_row( $sql, $params );
		}

		return $this->select( $sql, $params );
	}

	public function build_runtime()
	{
		$sql = 'SELECT
					p.permalink,
					p.id AS page_id,
					pv.page_layout_id,
					pv.percentage,
					pv.title,
					pv.contents
				FROM pages p
					JOIN page_versions pv ON pv.page_id = p.id AND pv.is_publishable = 1
				WHERE p.is_publishable = 1';

		return $this->select( $sql, [] );
	}

	public function get_permalink_dictionary()
	{
		$sql = "SELECT
					page_id AS node_id,
					max(parent_id) AS parent_node_id,
					max(parent) AS parent,
					permalink
				FROM (
				SELECT
					p2.id AS page_id,
					p.id AS parent_id,
					p.permalink AS parent,
					length(p.permalink) AS parent_length,
					p2.permalink
				FROM pages p
					LEFT JOIN pages p2 ON p2.permalink LIKE concat(p.permalink, '%')
				WHERE p.permalink != p2.permalink
				) a
				GROUP BY permalink
				ORDER BY permalink";
		$params = [];

		$dictionary = $this->select( $sql, $params );

		$return = [];
		foreach( $dictionary as $node )
		{
			$return[$node['node_id']] = $node;
		}

		return $return;
	}

}
