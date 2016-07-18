<?php

use \puffin\model\pdo as pdo;

class page_history extends pdo
{
	protected $table = 'page_history';

	public function read_by_page_id( $page_id )
	{
		$sql = "SELECT
					t.*,
					u.first_name,
					u.last_name
				FROM {$this->table} t
					LEFT JOIN users u on u.id = t.author_user_id
				WHERE t.page_id = :id";
		$params = [':id' => $page_id];
		return $this->select($sql, $params);
	}
}
