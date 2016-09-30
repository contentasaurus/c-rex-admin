<?php
namespace puffin\transformer;

class uuid
{
	private $prefix = 'c';

	public function __construct(){}

	public function uuid( $uuid )
	{
		return $this->prefix . $uuid;
	}
}
