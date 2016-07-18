<?php

use \puffin\model\pdo as pdo;

class page_script extends pdo
{
	protected $table = 'page_scripts';


	public function recreate( $page_id, $records )
	{
		$sql = "delete from {$this->table}
				where page_id = :page_id";

		$params = [
			':page_id' => $page_id
		];

		$this->execute($sql, $params);

		foreach($records as $record)
		{
			$this->create( $record );
		}
	}

	public function get_page_scripts( $page_id )
	{
		$types_model = new script_type();

		$types = $types_model->read();

		$return = [];

		foreach( $types as $type )
		{
			$sql = 'SELECT
						ps.id,
						ps.page_id,
						ps.script_id,
						st.name AS type_name,
						st.id AS script_type_id,
						s.name,
						ps.load_order

					FROM page_scripts ps
						JOIN scripts s ON s.id = ps.script_id
						JOIN script_types st ON st.id = s.script_type_id and ps.id = :id

					WHERE ps.page_id = :page_id
					ORDER BY ps.load_order';

			$params = [
				':id' => $type['id'],
				':page_id' => $page_id
			];

			$return[$type['name']] = $this->select( $sql, $params );
		}

		return $return;
	}

	public function get_page_script_ids( $page_id )
	{
		$sql = 'SELECT ps.script_id as id
				FROM page_scripts ps
				WHERE ps.page_id = :page_id';

		$params = [':page_id' => $page_id];

		$result = $this->select( $sql, $params );

		$return = [];
		foreach( $result as $res )
		{
			$return []= $res['id'];
		}

		return $return;
	}

}
