<?php

abstract class DBWrapper{

	protected $db;
		
	public function __construct() 
	{
		$this->db = null;
		$this->db = new PDO($this->getDSN(), DATABASE_LOGIN, DATABASE_PASS);
	}

	abstract protected function getDSN();

	public function getHandle()
	{
		return $this->db;
	}
	
}

?>