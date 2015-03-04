<?php

class UniqueSession {
		
	protected $id;

	public function __construct() 
	{
		$this->id = $this->generateRandomId(10);
	}

	public function getId()
	{
		return $this->id;
	}

	public function generateRandomId($length = 10)
	{
		$id = '';

		if ($length > 0) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$vocabularySize = strlen($characters);
		    for ($i = 0; $i < $length; $i++) {
		        $id .= $characters[rand(0, $vocabularySize - 1)];
		    }
		}

        return $id;
	}
}

?>