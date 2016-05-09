<?php

use \puffin\model\pdo as pdo;
use \puffin\password as password;

class user extends pdo
{
	const FAILURE = 0;
	const FAILURE_EMAIL_INVALID = -1;

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

	public function refresh()
	{
		if( !empty($_SESSION['user']) )
		{
			$user = $this->read( $_SESSION['user']['id'] );
			if( !empty($user) )
			{
				unset($user['password']);
				unset( $user['additional'] );
				$user = array_merge( $user, $this->get_additional( $user['id'] ) );
				$_SESSION['user'] = $user;
				return 1;
			}
			else
			{
				unset( $_SESSION['user'] );
				return 0;
			}
		}
		else
		{
			return -1;
		}
	}

	################

	protected function _check_role()
	{
		$success = $this->refresh();

		if( $success > 0 )
		{
			$roles = new role();
			$role = $roles->read( $_SESSION['user']['role_id'] );
			return $role['access_level'];
		}
		else
		{
			return -1;
		}

	}

	public function is_owner()
	{
		return $this->_check_role() == 255;
	}

	public function is_editor()
	{
		return $this->_check_role() >= 128;
	}

	public function is_author()
	{
		return $this->_check_role() >= 64;
	}

	public function is_disabled()
	{
		return $this->_check_role() <= 0;
	}
}
