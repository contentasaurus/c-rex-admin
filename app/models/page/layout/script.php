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
						psl.id,
						psl.page_layout_id AS layout_id,
						pst.name AS type_name,
						ps.id AS script_id,
						ps.script_type_id,
						ps.name,
						trim(ps.html) as html,
						psl.load_order

					FROM page_layout_scripts psl
						JOIN scripts ps ON ps.id = psl.script_id
						JOIN script_types pst ON pst.id = ps.script_type_id and pst.id = :id

					WHERE page_layout_id = :layout_id
					ORDER BY psl.load_order asc';

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
