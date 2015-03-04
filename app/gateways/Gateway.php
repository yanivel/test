<?php


class Gateway {

	protected $dbWrapper;

	public function __construct(DBWrapper $dbWrapper) {
		$this->dbWrapper = $dbWrapper;
	}

	public function findGatewayFor($clazz = '') {
		$gateway = null;

		$gatewayClazz = $clazz . 'Gateway';
		if (!empty($clazz) && class_exists($gatewayClazz)) {
			$gateway = new $gatewayClazz($this->dbWrapper);
		}

		return $gateway;
	}
}

?>