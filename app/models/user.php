<?php

use \puffin\model\pdo as pdo;
use \puffin\password as password;
use \puffin\message as message;

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

	public function change_password_by_token( $reset_token, $user_password, $confirm_password )
	{
		if( (!empty($user_password) && !empty($confirm_password)) && ($user_password == $confirm_password) )
		{
			$user = $this->get_by_reset_token( $reset_token );

			$password = new password();

			if( !empty($user) )
			{
				return $this->update( $user['id'], [
					'password' => $password->make( $user_password ),
					'reset_token' => NULL
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

	public function email_password_reset_confirmation( $email )
	{
		$sql = 'SELECT count(0) as num
				FROM users
				WHERE email = :email';

		$params = [
			':email' => $email
		];

		$email_exists = $this->select_one( $sql, $params );

		if( $email_exists )
		{
			$sql = 'UPDATE users
					SET reset_token = TO_BASE64(uuid())
					WHERE email = :email';

			$params = [
				':email' => $email
			];

			$this->execute( $sql, $params );

			$this->send_email( $email );

			return true;
		}
		else
		{
			return false;
		}
	}

	protected function send_email( $email )
	{
		$user = $this->get_by_email( $email );

		$mail = new \PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		// $mail->isSMTP();                                      // Set mailer to use SMTP
		// $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		// $mail->SMTPAuth = true;                               // Enable SMTP authentication
		// $mail->Username = 'user@example.com';                 // SMTP username
		// $mail->Password = 'secret';                           // SMTP password
		// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		// $mail->Port = 587;                                    // TCP port to connect to

		$mail->isSendmail();
		$mail->setFrom('no-reply@contentasaurus.net', 'No Reply');
		$mail->addAddress($email, "{$user['first_name']} {$user['last_name']}");     // Add a recipient
		$mail->addReplyTo('no-reply@contentasaurus.net', 'No Reply');
		$mail->isHTML(true);                                  // Set email format to HTML

		$url = SERVER_URL . '/auth/reset-confirm/' . $user['reset_token'];

		$mail->Subject = 'Password Reset';
		$mail->Body = "Someone has requested a password reset for your account. "
					. "To reset your password, click here: <a href=\"$url\">$url</a>.";

		$mail->AltBody = "Someone has requested a password reset for your account. "
					   . "To reset your password, visit $url";;

		return $mail->send();
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

	public function get_by_reset_token( $token )
	{
		$record = $this->select_row(
			'SELECT * FROM users WHERE reset_token = :reset_token',
			[':reset_token' => $token]
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
