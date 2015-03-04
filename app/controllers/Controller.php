<?php


abstract class Controller {

	protected $app;

	protected $gateway;

	protected $requestValidator;

	protected $jsonResponder;

	protected $requestParams;

	public function __construct(\Slim\Slim $app, RequestValidator $requestValidator = null) {
		$this->app = $app;
		$this->requestValidator = $requestValidator;
		$this->jsonResponder = new JsonResponder($app);
		$this->setGateway();
	}

	public function run() {
		try {
			$this->requestValidator->validate();
			$this->requestParams = $this->requestValidator->getRequestValues();
		} catch (Exception $e) {
			$this->handleRequestError();
		}
	}

	public function sendResponse($response)
	{
		$this->jsonResponder->setData($response);
		$this->jsonResponder->sendResponse();
	}

	protected function setGateway($clazz = '') {

		$gatewayClazz = !empty($clazz) ? $clazz : ($this->getControllerName() . 'Gateway');

		if (class_exists($gatewayClazz)) {
			$this->gateway = new $gatewayClazz($this->app->db);
		} else {
			$this->getWay = null;
		}
	}

	protected function getControllerName() 
	{
		$clazzName = get_called_class();
		return substr($clazzName, 0, strpos($clazzName, "Controller"));
	}

	protected function handleRequestError($code = 400, $message = '')
	{
		$this->jsonResponder->setErrorByCode($code);
		if (!empty($message)) {
			$this->jsonResponder->setErrorCustomMessage($message);
		}
		$this->jsonResponder->sendResponseAndStop();
	}

	protected function handleModelError($code = 500, $message = '')
	{
		$this->jsonResponder->setErrorByCode($code);
		if (!empty($message)) {
			$this->jsonResponder->setErrorCustomMessage($message);
		}
		$this->jsonResponder->sendResponseAndStop();
	}

	protected function getRequestParam($param)
	{
		return (isset($this->requestParams[$param]) ? $this->requestParams[$param] : null);
	}

}

?>