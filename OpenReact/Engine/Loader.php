<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of Loader
 *
 * @author Rayyan
 */
class Loader {
   
    protected $registry;
    
    public function __construct($registry) {
       $this->registry = $registry;
    }
    
    
    
    public function controller($path)
    {
        $action = new Action($path);
        
        $action->execute($this->registry);
    }
      
   
      
       
    }
   
