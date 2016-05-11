<?php

use \puffin\model\pdo as pdo;
use \puffin\password as password;

class user extends pdo
{
	const FAILURE = 0;
	const FAILURE_EMAIL_INVALID = -1;

	protected $connection = 'default';
	protected $table = 'users';
	protected $dynamic_columns = ['additional'];

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
			unset( $authenticated_record['additional'] );
			$authenticated_record = array_merge( $authenticated_record, $this->get_additional( $record['id'] ) );
			return $authenticated_record;
		}
		else
		{
			return $is_valid; #error codes defined in \puffin\password
		}

	}

	public function get_additional( $user_id )
	{
		$sql = "select column_json(additional) as additional from users where id = :id";
		$params = [ ':id' => $user_id ];
		$additional = $this->select_one( $sql, $params );
		$array = json_decode( $additional, $assoc = true );
		return $array;
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

		if( !empty($user['role_id']) )
		{
			$roles = new role();
			$role = $roles->read( $user['role_id'] );
			return $role['access_level'];
		}
		else
		{
			return -1;
		}

	}

	public function is_owner( $id )
	{
		return $this->_check_role( $id ) == 255;
	}

	public function is_editor( $id )
	{
		return $this->_check_role( $id ) >= 128;
	}

	public function is_author( $id )
	{
		return $this->_check_role( $id ) >= 64;
	}

	public function is_disabled( $id )
	{
		return $this->_check_role( $id ) <= 0;
	}
}
