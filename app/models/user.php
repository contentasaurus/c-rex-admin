<?php

use \puffin\model\pdo as pdo;
use \puffin\password as password;

class user extends pdo
{
	const FAILURE = 0;
	const FAILURE_EMAIL_INVALID = -1;

	protected $connection = 'default';
	protected $table = 'users';

	public function login( $email, $user_password )
	{
		$password = new password();

		$sql = "select id, password from users where email = :email";
		$params = [ ':email' => $email ];
		$record = $this->select_row( $sql, $params );

		if( empty($record) )
		{
			return self::FAILURE_EMAIL_INVALID;
		}

		$is_valid = $password->is_valid( $user_password, $record['password'] );

		if( $is_valid > 0 )
		{
			$authenticated_record = $this->read( $record['id'] );
			unset( $authenticated_record['password'] );
			return $authenticated_record;
		}
		else
		{
			return $is_valid; #error codes defined in \puffin\password
		}

	}

	public function change_password( $email, $user_password, $confirm_password )
	{
		if( (!empty($user_password) && !empty($confirm_password)) && ($user_password == $confirm_password) )
		{
			$user = $this->get_by_email( $email );

			$password = new password();

			if( !empty($user) )
			{
				return $this->update( $user['id'], [
					'password' => $password->make( $user_password )
				]);
			}
		}
		return false;
	}

	public function reset_password( $email )
	{
		$password = $this->generate_random_password();
		$change = $this->change_password( $email, $password, $password );
		debug($password);
	}

	protected function generate_random_password( $length = 10 )
	{
		$letters = range('a','z');
		$letters []= '#';	$letters []= '$';	$letters []= '@';	$letters []= '%';
		$letters []= '*';	$letters []= '!';	$letters []= '?';	$letters []= '&';

		shuffle($letters);
		$string = implode('',$letters);
		$password = substr($string, 0, $length);

		return $password;
	}

	public function get_by_email( $email )
	{
		$record = $this->select_row(
			'select * from users where email = :email',
			[':email' => $email]
		);

		if( !empty($record) )
		{
			unset($record['password']);
			return $record;
		}

		return false;
	}

	public function activate( $email )
	{
	}

	################

	protected function _check_role( $id )
	{
		$user = $this->read( $id );

		return $user['is_admin'];
	}

	public function is_owner( $id )
	{
		return $this->_check_role( $id ) == 2;
	}

	public function is_admin( $id )
	{
		return $this->_check_role( $id ) >= 1;
	}

	public function is_standard( $id )
	{
		return $this->_check_role( $id ) >= 0;
	}


}
