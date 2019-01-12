<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of Action
 *
 * @author Rayyan
 */
class Action {
    private $id;
    private $method = 'index';
    private $route;
    
    public function __construct($route)
    {
        $this->id = $route;
        $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));
                
		// Break apart the route
		while ($parts) {
			$file =  DIR_APPLICATION.'/controller/' . implode('/', $parts) . '.php';
                       
			if (is_file($file)) {
				$this->route = implode('/', $parts);
                                
				break;
			} else {
				$this->method = array_pop($parts);
                                
			}
		}
    }
    
    public function execute($registry,$args=array())
    {
        if (substr($this->method, 0, 2) == '__') {
			return new Exception('Error: Calls to magic methods are not allowed!');
		}
                
                $file = DIR_APPLICATION.'/controller/'.$this->route.'.php';
                $path = explode('/',$this->route);
                $class = array_pop($path);
               
                if (is_file($file)) {
                        include_once($file);
			$controller = new $class($registry);
            
		} else {
			return new \Exception('Error: Could not call ' . $this->route . '/' . $this->method . '!');
		}
                
                $reflection = new ReflectionClass($class);
                
                if ($reflection->hasMethod($this->method) && $reflection->getMethod($this->method)->getNumberOfRequiredParameters() <= count($args)) {
               
			return call_user_func_array(array($controller, $this->method), $args);
		} else {
			return new \Exception('Error: Could not call ' . $this->route . '/' . $this->method . '!');
		}
    }
    
}
