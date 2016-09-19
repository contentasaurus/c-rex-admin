<?php

use \puffin\model\pdo as pdo;

class datasource_test extends pdo
{
	protected $connection = 'datasource_test';
	protected $table = 'dual';

	public function show_schema_privileges( $username, $schema )
	{
		$schema = str_replace('_', '\_', $schema);

		$sql = "SELECT *
				FROM information_schema.schema_privileges
				WHERE table_schema = :schema
					AND grantee LIKE \"'$username'@%\"";

		$params = [
			':schema' => $schema
		];

		return $this->select( $sql, $params );
	}

	public function show_tables()
	{
		$sql = 'SHOW TABLES';
		$params = [];

		return $this->select( $sql, $params );
	}
}
