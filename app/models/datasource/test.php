<?php

use \puffin\model\pdo as pdo;

class datasource_test extends pdo
{
	protected $connection = 'datasource_test';
	protected $table = 'dual';

	public function show_tables()
	{
		$sql = 'SHOW TABLES';
		$params = [];

		return $this->select( $sql, $params );
	}

	public function create_table()
	{
		$sql = 'CREATE TABLE `__test_table__` (
  					`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					`value` int(11) DEFAULT NULL,
  					PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

		$statement = $this->select_raw( $sql );
		
		return [
			'errorCode' => $statement->errorCode(),
			'errorInfo' => $statement->errorInfo()
		];
	}

	public function delete_table()
	{
		$sql = 'DROP TABLE __test_table__';
		$statement = $this->select_raw( $sql );

		return [
			'errorCode' => $statement->errorCode(),
			'errorInfo' => $statement->errorInfo()
		];
	}

	public function create_view()
	{
		$sql = 'CREATE VIEW __test_view__ as SELECT * FROM __test_table__';
		$statement = $this->select_raw( $sql );
		return [
			'errorCode' => $statement->errorCode(),
			'errorInfo' => $statement->errorInfo()
		];
	}

	public function delete_view()
	{
		$sql = 'DROP VIEW __test_view__';
		$statement = $this->select_raw( $sql );

		return [
			'errorCode' => $statement->errorCode(),
			'errorInfo' => $statement->errorInfo()
		];
	}
}
