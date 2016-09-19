<?php

use \puffin\model\pdo as pdo;

class deployment extends pdo
{
	protected $table = 'deployments';

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
					d.key,
					u.first_name,
					u.last_name,
					da.name,
					d.deployed_at
					FROM deployments d
						JOIN users u ON u.id = d.deployed_by_user_id
						JOIN datasources da ON da.id = d.deployed_to_datasource_id
					$where";

		if( !empty($params) )
		{
			return $this->select_row( $sql, $params );
		}

		return $this->select( $sql, $params );
	}

}
