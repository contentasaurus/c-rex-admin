<?php

use \puffin\model\pdo as pdo;

class collection extends pdo
{
	protected $table = 'collections';
	protected $dynamic_columns = ['collection_data'];
}
