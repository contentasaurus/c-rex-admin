<?php

# permissions::is_owner();
# permissions::is_admin();
# permissions::is_standard();

class permissions
{
	private static $user = false;

	private static function init()
	{
		if( empty(self::$user) )
		{
			$user = new user();
			self::$user = $user->read( $_SESSION['user']['id'] );
		}
	}

	public static function is_owner()
	{
		self::init();
		return self::$user['is_admin'] == 2;
	}

	public static function is_admin()
	{
		self::init();
		return self::$user['is_admin'] >= 1;
	}

	public static function is_standard()
	{
		self::init();
		return self::$user['is_admin'] == 0;
	}
}
