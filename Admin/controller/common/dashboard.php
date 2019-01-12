<?php

/* 
 *  Damn Straight now copying only buying.
 */

class dashboard extends Controller
{
    private $error = array();
    
    public function index()
    {
        
        $data = array();
        $data['css'] = $this->document->getCss();
        $data['js'] = $this->document->getJs();
        
        
       
        
        if(!empty($this->cache->checkCache('main.js'))){
          $data['react_root'] = $this->cache->loadCache('main.js');
          
        }
 else {
        $app = trim(preg_replace('/\s+/', ' ', file_get_contents($this->document->get('main'))));

         
        $script = implode("\n",[$app]);
        
        $this->compiler->setErrorHandler('ErrorHandler');
        $this->compiler->Compile($script);
        $res = $this->compiler->get('code');
        
        
       
     $data['react_root'] = $this->cache->cacheFile('main.js',$res);
     
      }
        
      /*$this->react->setModuleLoader(function($path){
        $file = $this->document->get($path);
        if(is_file($file))
        {
            return file_get_contents($path);
        }
        else 
        {
            return null;
        }
           });
        
        
        $react_dom = file_get_contents($this->document->get('react_bundle'));
        
        $react_src = implode("\n",[$react_dom]);
        //echo $react_src;
        $this->react->createReactApp($react_src,$res);
        echo $this->react->execute();
            */
        //echo $res;
        
        $this->view->view('common/dashboard',$data);
       
    }
   
    public function ErrorHandler($e)
    {
        echo "Error ".$e;
    }
    
}
