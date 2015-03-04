<?php

class JsonResponder extends JsonSerializablePretty{
		
	protected $app;

	protected $response;

	protected $errorCode;

	protected $errorMessage;

	protected $data;


	public function __construct(\Slim\Slim $app) 
	{
		$this->app = $app;
		$this->response = $app->response;
		$this->errorCode = 0;
		$this->errorMessage = null;
		$this->data = null;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function getData() 
	{
		return $this->data;
	}

	public function setErrorCustomCode($code) 
	{
		$this->errorCode = $code;
	}

	public function getErrorCode() 
	{
		return $this->errorCode;
	}

	public function setErrorCustomMessage($message) 
	{
		$this->errorMessage = $message;
	}

	public function getErrorMessage() 
	{
		return $this->errorMessage;
	}

	public function setErrorByCode($code) {
		$this->errorCode = $code;
		$this->errorMessage = $this->response->getMessageForCode($code);
	}

	public function sendResponse() {
		$this->response->headers->set('Content-Type', 'application/json');
		$jsonedBody = $this->toJson(['errorCode','errorMessage','data'], 'ucfirst');
		$this->response->setBody($jsonedBody);
		if ($this->errorCode != 0) {
			$this->response->setStatus($this->errorCode);
		}
	}

	public function sendResponseAndStop() {
		$this->sendResponse();
		$this->app->stop();
	}

	
}

?>