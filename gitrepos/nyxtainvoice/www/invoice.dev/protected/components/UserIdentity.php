<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_homeUrl;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. databases).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*$users=array(
				  // username => password
				  'demo'=>'demo',
				  'admin'=>'admin',
			  );*/

		$user = User::model()->findByAttributes(array('username' => $this->username));
		if (empty($user))
			$user = new User;
		//echo 'usernme:' .$user->username;
		if ($this->username !== $user->username)
			//if(!isset($users[$this->username]))
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		elseif ($user->password !== md5($this->password))
			//($users[$this->username]!==$this->password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else {
			$this->_id = $user->id;
			$this->_homeUrl = $user->homeUrl;
			$this->errorCode = self::ERROR_NONE;
		}

		//echo $this->errorCode;
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function getHomeUrl()
	{
		return $this->_homeUrl;
	}
}