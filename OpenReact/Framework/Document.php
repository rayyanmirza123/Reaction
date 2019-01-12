<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of Document
 *
 * @author Rayyan
 */
class Document {
    
    private $css = array();
    private $js = array();
    public $map = array();
    
    public function addJSFiles($jscript = array())
    {
        foreach($jscript as $js){
        $this->map = array($this->getJsFileName($js) => $js);
        }
        $this->js = array_merge($this->js,$jscript);
    }
    
    public function addCSSFiles($cssX = array())
    {
        $this->css = array_merge($this->css,$cssX);
    }
    
    public function addJs($js)
    {
        $filename = $this->getJsFileName($js);
     
        if(array_key_exists($filename, $this->map))
        {
        array_push($this->js, $js);
        }
        else
        {
            $this->map[$filename] = $js;
            array_push($this->js,$js);
        }
    }
    
    public function addCss($css)
    {
        array_push($this->css,$css);
    }
    
    public function getCss()
    {
        return $this->css;
    }
    
    public function getJs()
    {
        return $this->js;
    }
    
    private function getJsFileName($js)
    {
        $part = pathinfo($js);
        $file = $part['filename'];
        return $file;
    }
    
    public function get($key)
    {
        return $this->map[$key];
    }
}

