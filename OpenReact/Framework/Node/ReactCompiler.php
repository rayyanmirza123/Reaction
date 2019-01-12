<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of ReactCompiler
 *
 * @author Rayyan
 */
class ReactCompiler {
   
    private $v8;
    private $script;
    private $min;
    private $babel;
    private $babel_path;
    private $source = array();
    private $errorHandler;
    
    public function __construct($min = false,$babel_path = '')
    {
        $this->min = $min;
        $this->babel_path = $babel_path;
        $this->v8 = new V8Js("server");
        $this->v8->response = new \Node\Response();
        $this->v8->setModuleLoader(function($path){
                $dir = $this->getBabelPath($path);
               
        if(is_file($dir))
        {
            echo $dir;
            return file_get_contents($dir);
        }
        else
        {
            return false;
    }});
        
    }
    
    public function Compile($script)
    {
        $this->script = $script;
        $this->source[] = "var console = {warn: function(){}, error: print};";
        $this->source[] = "var global = global || this, self = self || this, window = window || this;";
        
        $this->loadBabel();
        
        $this->source[] = $this->babel;
        
        $this->source[] = "var Babel = global.Babel;";
        
        $this->source[] = "var ReactDOM = global.ReactDOM;";
        
        $this->source[] = 'var output = Babel.transform( "'.$this->script.'" , { presets: ["es2015","react"] });'; //append .code for compiled
        
        $this->source[] = "server.response.setOutput(output);";
        
        $this->source[] = ";";
        
        $src = implode("\n",$this->source);
        
        $this->executeJS($src);
  
    }
    /*
     * Currently we are using standalone version 
     */
    private function loadBabel()
    {
        if(!empty($this->babel_path))
        {
            $this->babel = file_get_contents($this->babel_path);
        }
        else
        {
            $this->babel_path = DIR_WIN."Admin\\js\\";
            $this->babel = file_get_contents($this->babel_path."react_bundle.js");
        }
    }
       
    private function getBabelPath($file)
    {
        if($this->min)
        {
        return $this->babel_path.$file.".min.js";
    } 
    else {
       
        return $this->babel_path.$file.".js";
    }
    }
    
    public function setErrorHandler($handler)
    {
        $this->errorHandler = $handler;
    }
    
     private function executeJS($js) {
         
    try {
      ob_start();
      $this->v8->executeString($js,null,\V8Js::FLAG_FORCE_ARRAY);
      return ob_get_clean();
    } catch (V8JsException $e) {
      
        // default error handler blows up bad
        echo "<pre>";
        //echo $e->getMessage();
        echo "</pre>";
        echo "<br>";
        die();
    }
  }
  
  public function get($key)
  {
     return $this->v8->response->get($key);
  }

}
