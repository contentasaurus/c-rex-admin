<?php

use \puffin\model\pdo as pdo;

class script extends pdo
{
	protected $table = 'scripts';

	public function get_all_groups()
	{
		$types_model = new script_type();

		$types = $types_model->read();

		$return = [];

		foreach( $types as $type )
		{
			$sql = 'SELECT
						ps.id,
						pst.name AS type_name,
						ps.name,
						ps.html
					FROM scripts ps
						JOIN script_types pst ON ps.script_type_id = pst.id
					WHERE
						pst.id = :id
					ORDER BY
						pst.id, ps.name asc';

			$params = [
				':id' => $type['id']
			];

			$return[$type['name']] = $this->select( $sql, $params );
		}

		return $return;
	}

	public function get_by_type( $type ) 
	{
		$type_id = $this->id_by_type($type);

		$sql = "SELECT 
					s.name, 
					s.html AS content
				FROM 
					scripts AS s,
					script_types AS t
				WHERE 
					t.id = :type_id
				AND 
					s.script_type_id = t.id
				ORDER BY 
					s.priority 
				DESC";

		$params = [
			':type_id' => $type_id
		];

		return $this->select( $sql, $params );
	}

	private function id_by_type( $type ) 
	{
		$types_model = new script_type();
		$types = $types_model->read();

		foreach ($types as $key => $value) 
		{
			if($value['name'] == $type) 
			{
				return $value['id'];
			}
		}

		return false;
	}
}
