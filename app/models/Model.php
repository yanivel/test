<?php


abstract class Model extends JsonSerializablePretty{

	public function getPublicObject(array $properties) {
		return json_decode($this->toJson($properties, 'ucfirst'), true);
	}



}

?>