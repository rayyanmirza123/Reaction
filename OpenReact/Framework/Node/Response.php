<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of Response
 *
 * @author Rayyan
 */

namespace Node;

class Response {
   private $data = array();
   
   public function setOutput($data = array())
   {
       $this->data = array_merge($this->data,$data);
   }
   
   public function get($key)
   {
       return $this->data[$key];
   }
}
