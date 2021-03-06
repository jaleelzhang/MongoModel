<?php

function is_assoc ($arr) {
    return (is_array($arr) && count(array_filter(array_keys($arr),'is_string')) == count($arr));
}

class Hash {

	public static function create($array) {
		return self::_array_to_object($array);
	}

    public function is_set($key) {
        return isset($this->$key);
    }

	protected static function _array_to_object($array) {
		if(!is_assoc($array)) {
			return $array;
		}

		$object = new Hash();
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $name=>$value) {
				$name = trim($name); // no strtolower, but please use lowercase, it's prettier.
				if (!empty($name)) {
					$object->$name = Hash::_array_to_object($value);
				}
			}
			return $object; 
		} else if (is_array($array) && count($array) == 0) {
			return new Hash;
		} else {
			return null;
		}
	}
}
