<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of ReactJs
 *
 * @author Rayyan
 */
class ReactJS {
    
    private $v8;
    private $code;
    private $errorHandler;
    
    public function __construct() {
        $this->v8 = new V8Js();
    }
    
    public function execute()
    {
       try {
      ob_start();
      $this->v8->executeString($this->code);
      return ob_get_clean();
    } catch (Exception $e) {
      if ($this->errorHandler) {
        call_user_func($this->errorHandler, $e);
      } else {
        // default error handler blows up bad
        echo "<pre>";
        echo $e->getMessage();
        echo "</pre>";
        echo $this->code;
        die();
      }
    }
    }
    
    public function setModuleLoader(callable $t)
    {
        $this->v8->setModuleLoader($t);
    }
    
    public function createReactApp($reactSrc,$code)
    {
    
   $react = array();
    // stubs, react
    $react[] = "var console = {warn: function(){}, error: print};";
    $react[] = "var global = global || this, self = self || this, window = window || this;";
    $react[] = $reactSrc;
    $react[] = "var React = global.React;";
    $react[] = "var ReactDOM = global.ReactDOM;";
    $react[] = "var ReactDOMServer = global.ReactDOMServer;";
    $react[] = "var ReactClass = global.ReactClass;";
    // app's components
    $react[] = $code;
    $react[] = ';';
    
    $this->code = implode("\n", $react);
    //echo $this->code;
    }
    
   
}
