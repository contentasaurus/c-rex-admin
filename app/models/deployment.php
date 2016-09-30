<?php

use \puffin\model\pdo as pdo;

class deployment extends pdo
{
	protected $table = 'deployments';
	protected $connection = 'datasource_deploy';

	public function read( $id = false )
	{
		$where = '';
		$params = [];

		if( !empty($id) )
		{
			$where .= ' WHERE p.id = :id';
			$params[':id'] = $id;
		}

		$sql = "SELECT *
				FROM __recent_deployments
				$where
				ORDER BY created_at desc";

		if( !empty($params) )
		{
			return $this->select_row( $sql, $params );
		}

		return $this->select( $sql, $params );
	}
}
