<?php

use \puffin\model\pdo as pdo;

class page extends pdo
{
	protected $table = 'pages';

	public function read( $id = false )
	{
		$sql = 'SELECT
					p.*,
					ps.name AS page_status
				FROM pages p
					LEFT JOIN page_status ps ON ps.id = p.page_status_id
				WHERE 1=1 ';
		$params = [];

		if( !empty($id) )
		{
			$sql .= ' AND p.id = :id';
			$params[':id'] = $id;
			return $this->select_row( $sql, $params );
		}

		return $this->select( $sql, $params );
	}

	public function for_build()
	{
		$sql = 'SELECT
					p.id,
					p.page_name,
					p.permalink,
					p.page_layout_id,
					pl.name as page_layout_name,
					p.page_content
				FROM pages p
					JOIN page_layouts pl ON pl.id = p.page_layout_id';

		return $this->select( $sql, [] );
	}
}
