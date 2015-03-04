<?php


class CartGateway extends Gateway{

	public function addItem(Cart $cart, Item $item) {
		$db = $this->dbWrapper->getHandle();
		
		$id = $item->getId();
		if (ctype_digit($id) === false) {
			throw new ClientBadRequestException("Bad item id");
		}

		$query = "INSERT INTO carts_to_items(cartId, itemId) 
					  SELECT cartsTemp.cartId, :itemId
					   FROM (SELECT carts.cartId FROM carts WHERE sessionId = :sessionId 
					  	   AND EXISTS (SELECT itemId FROM items WHERE itemId = :itemId)
					  	   ) as cartsTemp";
		
		$params = [
					':sessionId' => $cart->getSessionId(),
					':itemId' => $id 
				  ];



		$sth = $db->prepare($query);
		$sth->execute($params);

		return true;
	}

	public function deleteItem(Cart $cart, Item $item) {
		$db = $this->dbWrapper->getHandle();

		$query = "DELETE FROM carts_to_items WHERE itemId = :itemId AND cartId = (SELECT cartId FROM carts WHERE sessionId = :sessionId)";

		$params = [
					':itemId' => $item->getId(),
					':sessionId' => $cart->getSessionId()  
				  ];
		
		$sth = $db->prepare($query);
		$sth->execute($params);

		if ($sth->rowCount() == 0) {
			throw new ClientBadRequestException("Item is not in the cart");
		}

		return true;
	}


	public function getCart(Cart $cart) {
		$db = $this->dbWrapper->getHandle();

		$query = "SELECT items.itemId as itemId , items.itemName as itemName, items.itemPrice as itemPrice, items.itemImage as itemImage FROM items, carts_to_items, carts
					WHERE carts_to_items.itemId = items.itemId 
					AND carts_to_items.cartId = carts.cartId 
					AND carts.sessionId = :sessionId";

		$params = [
					':sessionId' => $cart->getSessionId()            
				  ];
		
		$sth = $db->prepare($query);
		$sth->execute($params);

		$items = array();
		while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
			$items[] = new Item($result['itemId'], $result['itemName'], $result['itemPrice'], $result['itemImage']);
		}


		$cart->setItems($items);

		return $cart;
	}


	public function createCart(Cart $cart) {
		$db = $this->dbWrapper->getHandle();

		$query = "INSERT INTO carts(sessionId) VALUES(:sessionId)";
		$params = [
					':sessionId' => $cart->getSessionId()
				  ];
		
		$sth = $db->prepare($query);
		$sth->execute($params);

		$id = $db->lastInsertId();

		$cart->setId($id);

		return $cart;
	}

}

?>