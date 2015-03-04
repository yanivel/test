<?php

class Cart extends Model{

	protected $sessionId;

	protected $items;

	public function __construct($sessionId, $items = array()) {
		$this->sessionId = $sessionId;
		$this->items = $items;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function setLogin($login) 
	{
		$this->login = $login;
	}

	public function getSessionId() 
	{
		return $this->sessionId;
	}

	public function setSessionId($sessionId) 
	{
		$this->sessionId = $sessionId;
	}

	public function getId() 
	{
		return $this->id;
	}

	public function setId($id) 
	{
		$this->id = $id;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function setItems($items)
	{
		$this->items = $items;
	}

	public function getPublicObject(array $properties) {
		$filterObject = parent::getPublicObject($properties);

		$filterObject['Items'] = array();

		foreach ($this->items as $item) {
			$filterObject['Items'][] = $item->getPublicObject(['itemId', 'itemName', 'itemPrice', 'itemImage']);
		}
		
		return $filterObject;
	}
}

?>