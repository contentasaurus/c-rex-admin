<?php

use \puffin\model\pdo as pdo;

class page_log extends pdo
{
	protected $table = 'page_logs';

	public function read_by_page_id( $page_id )
	{
		$sql = "SELECT
					pl.id,
					pl.page_id,
					u.first_name,
					u.last_name,
					ps_new.name AS new_page_status,
					ps_prev.name AS prev_page_status,
					pl.comment,
					pl.created_at
				FROM page_logs pl
					LEFT JOIN users u ON u.id = pl.user_id
					LEFT JOIN page_status ps_new ON ps_new.id = pl.new_page_status_id
					LEFT JOIN page_status ps_prev ON ps_prev.id = pl.prev_page_status_id
				WHERE pl.page_id = :id
				ORDER BY pl.created_at desc";
		$params = [':id' => $page_id];
		return $this->select($sql, $params);
	}
}
