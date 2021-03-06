<?php

use \puffin\model\pdo as pdo;

class page_history extends pdo
{
	protected $table = 'page_history';

	public function read_by_page_id( $page_id )
	{
		$sql = "SELECT
					t.*,
					u.first_name as author_first_name,
					u.last_name as author_last_name,
					pl.name as page_layout_name,
					ps.name AS page_status_name
				FROM {$this->table} t
					LEFT JOIN users u on u.id = t.author_user_id
					LEFT JOIN page_layouts pl on pl.id = t.page_layout_id
					LEFT JOIN page_status ps ON ps.id = t.page_status_id
				WHERE t.page_id = :id";
				
		$params = [':id' => $page_id];
		return $this->select($sql, $params);
	}
}
