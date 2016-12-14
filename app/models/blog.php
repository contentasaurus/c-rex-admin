<?php

use \puffin\model\pdo as pdo;

class blog extends pdo
{
	protected $table = 'blogs';

	public function get_by_slug( $slug )
	{
		$sql = 'SELECT *
				FROM blogs
				WHERE slug = :slug';

		$params = [
			':slug' => $slug
		];

		return $this->select_row( $sql, $params );
	}

	public function check_slug_for_unique( $slug )
	{
		$suffix = '';
		$i = 1;
		do
		{
			if( $i > 1 )
			{
				$suffix = '-'.$i;
			}

			$sql = 'SELECT count(0) as num
					FROM blogs
					WHERE slug = :slug';

			$new_slug = $slug.$suffix;

			$params = [
				':slug' => $new_slug
			];

			$num = $this->select_one( $sql, $params );

			if( $num != 0 )
			{
				$i++;
			}

		}
		while( $num != 0 );

		return $new_slug;

	}

	public function recheck_slug_for_unique( $id, $slug )
	{
		$suffix = '';
		$i = 1;
		do
		{
			if( $i > 1 )
			{
				$suffix = '-'.$i;
			}

			$sql = 'SELECT count(0) as num
					FROM blogs
					WHERE slug = :slug and id != :id';

			$new_slug = $slug.$suffix;

			$params = [
				':id' => $id,
				':slug' => $new_slug
			];

			$num = $this->select_one( $sql, $params );

			if( $num != 0 )
			{
				$i++;
			}

		}
		while( $num != 0 );

		return $new_slug;

	}
}
