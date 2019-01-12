<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of Registry
 *
 * @author Rayyan
 */
final class Registry {
    private $data  = array();
    
    public function set($key,$value)
    {
        $this->data[$key] = $value;
    }
    
    public function get($key)
    {
        return $this->data[$key];
    }
    
    public function has($key) {
		return isset($this->data[$key]);
	}
}
