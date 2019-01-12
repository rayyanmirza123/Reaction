<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of View
 *
 * @author Rayyan
 */
class View {
    
    private $doc;
    
    public function __construct($service)
    {
        $this->doc = DIR_APPLICATION.$service."\\view\\";
        echo $this->doc;
    }
    
    public function view($file,$data=array())
    {
        $view = $this->doc.$file.".php";
       
        if(is_file($view))
        {
            include_once($view);
        }
    }
    
    
}
