<?php

use \puffin\model\pdo as pdo;

class dam_media_tag extends pdo
{
	protected $table = 'dam_media_tags';

	public function tags_by_media_id( $id = '' )
	{
		if( empty($id) )
		{
			return false;
		}
		else
		{
			$sql = "SELECT
						tag_id
					FROM dam_media_tags
					WHERE media_id = :id";

			$params = [
				':id' => $id
			];

			return $this->select( $sql, $params );
		}

	}
}
