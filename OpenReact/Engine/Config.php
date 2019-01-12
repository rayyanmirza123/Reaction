<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of Config
 *
 * @author Rayyan
 */
class Config {
     private $data = array();
    
    public function load($file)
    {
        $file = DIR_WIN_CONFIG.$file.".php";
        if(is_file($file))
        {
            $_ = array();
            require_once $file;
            $this->data = array_merge($this->data,$_);
        }
    }
    
    public function get($key)
    {
        return $this->data[$key];
    }
}
