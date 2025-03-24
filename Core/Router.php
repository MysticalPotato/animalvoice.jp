<?php

namespace Core;

use Core\App;
use Core\Localization;
use Core\Middleware\Guest;
use Core\Middleware\Auth;
use Core\Middleware\Middleware;

class Router {
	protected $routes = [];
	
	public function add($method, $uri, $controller, $middleware = null) {
		$uri = trim($uri, '/');
		$this->routes[] = compact('method', 'uri', 'controller', 'middleware');
		return $this;
	}
	
	public function get($uri, $controller) {
		$this->add('GET', $uri, $controller);
		return $this;
	}
	
	public function post($uri, $controller) {
		return $this->add('POST', $uri, $controller);
	}
	
	public function delete($uri, $controller) {
		return $this->add('DELETE', $uri, $controller);
	}
	
	public function patch($uri, $controller) {
		return $this->add('PATCH', $uri, $controller);
	}
	
	public function put($uri, $controller) {
		return $this->add('PUT', $uri, $controller);
	}

	public function only($key) {
		$this->routes[array_key_last($this->routes)]['middleware'] = $key;
		return $this;
	}

	public function prefix($prefix) {
		foreach($this->routes as $route) {
			$this->add($route['method'], $prefix . '/' . $route['uri'], $route['controller'], $route['middleware']);
			// if($route['method'] === strtoupper($method)) {
			// 	$this->add($route['method'], $prefix . '/' . $route['uri'], $route['controller'], $route['middleware']);
			// }
		}
	}
	
	public function route($uri, $method) {
		// Source: https://medium.com/@majdsoubh/implementing-php-routing-with-dynamic-parameters-18940bd80795

		foreach($this->routes as $route) {

			// Get the requested route.
			$requestedRoute = trim($uri, '/');

			// Transform route to regex pattern.
			$routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches) {
				return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
			}, $route['uri']);

			// Add the start and end delimiters.
            $routeRegex = '@^' . $routeRegex . '$@';

			// Check if the requested route matches the current route pattern.
            if (preg_match($routeRegex, $requestedRoute, $matches) && $route['method'] === strtoupper($method)) {

				// Get all user requested path params values after removing the first matches.
                array_shift($matches);
                $routeParamsValues = $matches;

				 // Find all route params names from route and save in $routeParamsNames
				 $routeParamsNames = [];
				if (preg_match_all('/{(\w+)(:[^}]+)?}/', $route['uri'], $matches)) {
					$routeParamsNames = $matches[1];
				}

				// Combine between route parameter names and user provided parameter values.
                $routeParams = array_combine($routeParamsNames, $routeParamsValues);

				// Set language
				$localeSet = App::setLocale($routeParams['locale'] ?? APP_LOCALE);
			
				if($localeSet) {
					// Redirect if unauthorized
					Middleware::resolve($route['middleware']);

					// Return path to matching controller
					return require base_path('Http/controllers/' . $route['controller']);
				}
			}
		}
		
		$this->abort();
	}

	public function previousUrl() {
		return $_SERVER['HTTP_REFERER'];
	}
	
	protected function abort($code = 404) {
		http_response_code($code);
		require base_path("views/{$code}.php");
		die();
	}
}