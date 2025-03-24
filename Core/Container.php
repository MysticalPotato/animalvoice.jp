<?php

namespace Core;

class Container {

	protected $bindings = [];
	protected $instances = [];

	public function bind($key, $resolver) {
		$this->bindings[$key] = $resolver;
	}

	public function singleton($key, $resolver) {
		$this->bind($key, $resolver);
		$this->instances[$key] = null;
	}
	
	public function resolve($key) {
		if(array_key_exists($key, $this->instances)) {
			if($this->instances[$key] === null) {
				$this->instances[$key] = call_user_func($this->bindings[$key]);
			}
			return $this->instances[$key];
		}

		elseif(array_key_exists($key, $this->bindings)) {
			return call_user_func($this->bindings[$key]);
		}

		throw new \Exception("No matching binding found for {$key}");
	}
}