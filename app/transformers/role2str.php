<?php
namespace puffin\transformer;

class role2str
{
	private $roles = [];

	public function __construct(){}

	public function role2str( $role_id )
	{
		if( empty($this->roles) )
		{
			$this->get_roles();
		}

		return $this->roles[$role_id];
	}

	private function get_roles()
	{
		$r = new \role();
		$roles = $r->read();

		foreach( $roles as $role )
		{
			$this->roles[$role['id']] = $role['name'];
		}

	}

}
