<?php

class CartController extends Controller {

	public function addItem() {

		$sessionId = $this->getRequestParam('SessionId');
		$itemId = $this->getRequestParam('ItemId');

		$item = new Item($itemId);
		$cart = new Cart($sessionId);

		try {
			$this->gateway->addItem($cart, $item);
		} catch (ClientBadRequestException $e) {
			$this->handleRequestError();
			return false;
		} catch (Exception $e) {
			$this->handleModelError();
			return false;
		}
		

		$this->sendResponse(null);

	}

	public function deleteItem() {

		$sessionId = $this->getRequestParam('SessionId');
		$itemId = $this->getRequestParam('ItemId');

		$item = new Item($itemId);

		$cart = new Cart($sessionId);

		try {
			$this->gateway->deleteItem($cart, $item);
		} catch (ClientBadRequestException $e) {
			$this->handleRequestError(400,$e->getMessage());
			return false;
		} catch (Exception $e) {
			$this->handleModelError();
			return false;
		}
		

		$this->sendResponse(null);
	}

	public function getCart() {
		$sessionId = $this->getRequestParam('SessionId');

		$cart = new Cart($sessionId);

		$this->gateway->getCart($cart);

		$publicCart = $cart->getPublicObject(['items']);
		$this->sendResponse($publicCart['Items']);
	}
}

?>