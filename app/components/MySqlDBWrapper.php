<?php

class MySqlDBWrapper extends DBWrapper{

	protected $db;

	protected function getDSN()
	{
        return "mysql:host=localhost;dbname=".DATABASE_NAME;
	}

}

?>