<?php


class UserGateway extends Gateway{

	protected $dbWrapper;

	public function registerUser(User $user) {
		$dbHandle = $this->dbWrapper->getHandle();
		$user->setId(0);

		$query = "INSERT INTO Users(username, password)
					VALUES( :username, :password)";

		$params = [
					':username' => $user->getUserName(),
					':password'	 => $user->getPassword()   
				  ];
		
		$sth = $dbHandle->prepare($query);
		$sth->execute($params);

		$id = $dbHandle->lastInsertId();

		$user->setId($id);
		
		if ($user->getId() == 0) {
			throw new ClientBadRequestException("User already exists");
		}


		return $user;
	}

	public function loginUser(User $user) {
		$dbHandle = $this->dbWrapper->getHandle();


		$query = "SELECT userId FROM users WHERE userName = :username AND password = :password";
		$params = [
					':username'	 => $user->getUserName(),
					':password'  => $user->getPassword()
				  ];
		
		$sth = $dbHandle->prepare($query);
		$result = $sth->execute($params);
		
		if ($sth->rowCount() == 0) {
			throw new ClientBadRequestException("Could not login user");
		} 
		$result = $sth->fetch(PDO::FETCH_ASSOC);

		$sessionId = (new UniqueSession())->getId();

		$query = "UPDATE Users SET sessionId = :sessionId WHERE userId = :userId";
		$params = [
					':sessionId' => $sessionId,
					':userId' => $result['userId']
				  ];
		
		$sth = $dbHandle->prepare($query);
		$sth->execute($params);

		$user->setId($result['userId']);
		$user->setSessionId($sessionId);

		$cartGateway = $this->findGateWayFor('Cart');
		$cartGateway->createCart(new Cart($sessionId));

		return $user;
	}

}

?>