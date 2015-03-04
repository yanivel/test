<?php

class JsonSerializablePretty{

		public function toJson(array $properties, $keyDecorator = '', $valueDecorator = '') {

		$clazz = get_called_class();

		$toEncode = array();
		foreach($properties as $property ) {
			if (property_exists($clazz, $property)) {
				$key =  (is_callable($keyDecorator)) ? call_user_func($keyDecorator, $property) : $property;
				$value = (is_callable($valueDecorator)) ? call_user_func($valueDecorator, $this->$property) : $this->$property;
				$toEncode[$key] = $value;
			}
		}

		return json_encode($toEncode);
	}
}

?>