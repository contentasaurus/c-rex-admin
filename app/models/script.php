<?php

use \puffin\model\pdo as pdo;

class script extends pdo
{
	protected $table = 'scripts';

	public function get()
	{
		$sql = "SELECT
					s.id,
					s.name,
					t.name AS type,
					s.created_at,
					s.updated_at,
					s.priority
				FROM
					scripts AS s
				LEFT JOIN
					script_types AS t
				ON
					t.id = s.script_type_id
				ORDER BY
					s.priority
				DESC";

		return  $this->select( $sql );
	}

	public function get_all_groups( $page_layout_id )
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
						ps.html,
						ifnull(pls.load_order, "null") AS load_order

					FROM  scripts ps
						JOIN script_types pst ON ps.script_type_id = pst.id
						LEFT JOIN page_layout_scripts pls ON pls.script_id = ps.id

					WHERE
						pst.id = :id
						and pls.page_layout_id = :page_layout_id

					ORDER BY
						load_order ASC';


			$params = [
				':id' => $type['id'],
				':page_layout_id' => $page_layout_id
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
