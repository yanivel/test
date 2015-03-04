<?php

class UserController extends Controller {

	public function registerUser() {

		$username = $this->getRequestParam('UserName');
		$password = $this->getRequestParam('Password');

		$user = new User($username, md5($password)); // simple encoding for now..
		try {
			$this->gateway->registerUser($user);
		} catch (ClientBadRequestException $e) {
			$this->handleRequestError(400, $e->getMessage());
			return false;
		} catch (Exception $e) {
			$this->handleModelError();
			return false;
		}

		$this->sendResponse($user->getPublicObject(['userId', 'sessionId', 'userName']));

	}

	public function loginUser() {

		$username = $this->getRequestParam('UserName');
		$password = $this->getRequestParam('Password');
		
		$user = new User($username, md5($password));

		try {
			$this->gateway->loginUser($user);
		} catch (ClientBadRequestException $e) {
			$this->handleRequestError(400, $e->getMessage());
			return false;
		} catch (Exception $e) {
			$this->handleModelError();
			return false;
		}

		$this->sendResponse($user->getPublicObject(['userId', 'sessionId', 'userName']));
	}
}

?>