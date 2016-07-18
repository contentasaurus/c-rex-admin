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
}
