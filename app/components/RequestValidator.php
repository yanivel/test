<?php

class RequestValidator {
		
	protected $request;

	protected $requiredParams;

	protected $requestValues;

	public function __construct(Slim\Http\Request $request) 
	{
		$this->request = $request;
		$this->requestValues = array();
		$this->requiredParams = array();
	}

	public function requireParams(array $required) {
		$this->requiredParams = array_change_key_case($required, CASE_LOWER);
	}

	public function validate()
	{
		$paramValues = array();

		if ($this->hasHeadParams()) {

			$headParams = $this->getRequiredParams('head');
			$headers = $this->request->headers;
			foreach($headParams as $param) {
				$paramValue = $headers->get($param);

				if (is_null($paramValue)) {

					throw new MissingRequiredParamException("Missing HEAD parameter " . $param);
				} else {
					$paramValues[$param] = $paramValue;
				}
			}
		}

		if ($this->hasGetParams()) {

			$getParams = $this->getRequiredParams('get');
			foreach($getParams as $param) {
				$paramValue = $this->request->get($param);
				if (is_null($paramValue)) {
					throw new MissingRequiredParamException("Missing GET parameter " . $param);
				} else {
					$paramValues[$param] = $paramValue;
				}
			}
		} else if ($this->hasPostParams()) {

			$getParams = $this->getRequiredParams('post');
			foreach($getParams as $param) {
				$paramValue = $this->request->post($param);
				if (is_null($paramValue)) {
					throw new MissingRequiredParamException("Missing POST parameter " . $param);
				} else {
					$paramValues[$param] = $paramValue;
				}
			}
		}

		$this->requestValues = $paramValues;
		return $paramValues;
	}

	public function getRequiredParams($type) {
		$type = strtolower($type);
		return $this->requiredParams[$type];
	}

	public function hasHeadParams() {
		return $this->hasTypeParams('head');
	}

	public function hasGetParams() {
		return $this->hasTypeParams('get');
	}

	public function hasPostParams() {
		return $this->hasTypeParams('post');
	}

	public function hasTypeParams($type) {
		$type = strtolower($type);
		return (isset($this->requiredParams[$type]) && !empty($this->requiredParams[$type]));
	}

	public function getRequestValues() {
		return $this->requestValues;
	}
}

?>