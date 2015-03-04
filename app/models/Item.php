<?php

class Item extends Model{

	protected $itemId;

	protected $itemName;

	protected $itemPrice;

	protected $itemImage;

	public function __construct($itemId, $itemName = '', $itemPrice = '', $itemImage = '') {
		$this->itemId = $itemId;
		$this->itemName = $itemName;
		$this->itemPrice = $itemPrice;
		$this->itemImage = $itemImage;		
	}

	public function getId()
	{
		return $this->itemId;
	}

	public function setId($itemId) 
	{
		$this->itemId = $itemId;
	}

	public function getName() 
	{
		return $this->itemName;
	}

	public function setName($itemName) 
	{
		$this->itemName = $itemName;
	}

	public function getPrice() 
	{
		return $this->itemPrice;
	}

	public function setPrice($itemPrice) 
	{
		$this->itemPrice = $itemPrice;
	}

	public function getImage() 
	{
		return $this->itemImage;
	}

	public function setImage($itemImage) 
	{
		$this->itemImage = $itemImage;
	}

	
}

?>