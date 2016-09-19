<?php

use \puffin\model\pdo as pdo;

class page_data extends pdo
{
	protected $table = 'page_data';

	public function read_by_page_id( $page_id )
	{
		$sql = "SELECT
					pd.id,
					pd.page_id,
					pd.reference_name,
					u.first_name,
					u.last_name,
					d.name as datatype_name,
					pd.updated_at
				FROM page_data pd
					LEFT JOIN users u ON u.id = pd.author_user_id
					LEFT JOIN datatypes d on d.id = pd.datatype_id
				WHERE pd.page_id = :id
				ORDER BY pd.created_at desc";
		$params = [':id' => $page_id];
		return $this->select($sql, $params);
	}
}
