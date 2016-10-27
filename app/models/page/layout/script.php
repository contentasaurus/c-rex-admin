<?php

use \puffin\model\pdo as pdo;

class page_layout_script extends pdo
{
	protected $table = 'page_layout_scripts';


	public function recreate( $page_layout_id, $records )
	{
		$sql = "delete from {$this->table}
				where page_layout_id = :page_layout_id";

		$params = [
			':page_layout_id' => $page_layout_id
		];

		$this->execute($sql, $params);

		foreach($records as $record)
		{
			$this->create( $record );
		}
	}

	public function get_layout_scripts( $layout_id )
	{
		$types_model = new script_type();

		$types = $types_model->read();

		$return = [];

		foreach( $types as $type )
		{
			$sql = 'SELECT
						st.name AS type_name,
						s.id AS script_id,
						s.script_type_id,
						s.name,
						ifnull((SELECT pls.load_order FROM page_layout_scripts pls WHERE pls.page_layout_id = :layout_id AND pls.script_id = s.id), "null") AS load_order

					FROM scripts s
						JOIN script_types st ON st.id = s.script_type_id

					WHERE
						s.script_type_id = :id

					ORDER BY load_order ASC, s.name';


			$params = [
				':id' => $type['id'],
				':layout_id' => $layout_id
			];

			$return[$type['name']] = $this->select( $sql, $params );
		}

		return $return;
	}

	public function get_layout_script_ids( $layout_id )
	{
		$sql = 'SELECT psl.script_id as id
				FROM page_layout_scripts psl
				WHERE psl.page_layout_id = :layout_id';
		$params = [':layout_id' => $layout_id];

		$result = $this->select( $sql, $params );

		$return = [];
		foreach( $result as $res )
		{
			$return []= $res['id'];
		}

		return $return;
	}

}
