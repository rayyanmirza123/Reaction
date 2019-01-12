<?php

class ContextFilter {

private $context;
private $path;
private $request;
private $reserve = array();

public function __construct($request,$reservere = array())
{
    $this->request = $request;
    $this->reserve = $reserve;
}

private function pre_process_request($request)
{
 $server = $this->request->server;
 $post = $this->request->post;
 $get = $this->request->get;
    
    if(!empty($get))
    {
       $this->path = urldecode($server['REQUEST_URI']);
       $parts = explode('/',$this->path);
       $same = array_intersect($this->reserve,$parts);
       
        if(!empty($same))
        {
            /*
            *  if a request to access reserved path is made 
            * we have to do security check, which is not implemented yet
            * so simply do nothing when we encounter such situations
            */
               
        }
        /*
        *  implement categorization of url as /category/..nth-sub-category/product;
        */
        
        
    }
    

}
    
 
    
}
