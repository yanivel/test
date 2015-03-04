<?php


class User extends Model{

	protected $userName;

	protected $password;

	protected $userId;

	protected $sessionId;

	public function __construct($userName, $password, $userId = -1) {
		$this->userName = $userName;
		$this->password = $password;
		$this->userId = $userId;
		$this->sessionId = 0;
	}

	public function getUserName() 
	{
		return $this->userName;
	}

	public function setUserName($userName) 
	{
		$this->userName = $userName;
	}

	public function getPassword() 
	{
		return $this->password;
	}

	public function setPassword($password) 
	{
		$this->password = $password;
	}

	public function getId() 
	{
		return $this->userId;
	}

	public function setId($userId) 
	{
		$this->userId = $userId;
	}

	public function getSessionId() 
	{
		return $this->sessionId;
	}

	public function setSessionId($sessionId) 
	{
		$this->sessionId = $sessionId;
	}
}

?>