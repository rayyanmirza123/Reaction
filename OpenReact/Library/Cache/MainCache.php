<?php

/*
 *  Damn Straight now copying only buying.
 */

/**
 * Description of MainCache
 *
 * @author Rayyan
 * 
 */

// very important call this class after calling Config in framework

class MainCache {
   
    private $registry;
    private $main_cache;
    private $cache_map;
    private $main_cache_map = 'MainCacheMap.txt';
    
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->getServicePath();
        if(!file_exists($this->main_cache.$this->main_cache_map))
        {
            $this->createCacheMap();
        }
    }
    
    
    
    private function getServicePath()
    {
        $config = $this->registry->get('config');
        $this->main_cache = $config->get('default_cache');
    }
    
    public function cacheFile($file,$data)
    {

        $name = $this->getCacheName($file);
        if(!empty($name))
        {
            $this->deleteCache($file,$name);
        }
        
        $new_name = $this->generateCacheName($file);
        file_put_contents($this->main_cache.$new_name, $data);
        
        $this->updateCacheMap($file, $new_name);
      
        return $this->main_cache.$new_name;
    }
    
    private function generateCacheName($file)
    {
        $range = range(0,1000);
        shuffle($range);
        $index = rand(0,1000);
        $prefix = $range[$index];
        
        $basename = pathinfo($file,PATHINFO_FILENAME);
        $extension = pathinfo($file,PATHINFO_EXTENSION);
        
        $new_file = $basename."_".$prefix.".$extension";
        
        return $new_file;
    }
    
    
    public function checkCache($file)
    {
        $name = $this->getCacheName($file);
        print_r($name);
        return $name;
    }
    
    private function createCacheMap()
    {
        $this->cache_map = fopen($this->main_cache_map, "w+");
        fclose($this->cache_map);
    }
    
    private function updateCacheMap($file,$new_file)
    {
        $data = $file."=".$new_file;
        $this->cache_map = fopen($this->main_cache_map, "a+");
        fwrite($this->cache_map, $data);
        fclose($this->cache_map);
    }
    
    private function getCacheName($file)
    {
        
        $this->cache_map = fopen($this->main_cache_map, "a+");
        
        while(!feof($this->cache_map))
        {
            $map = fgets($this->cache_map);
            
            $ret = explode("=",$map);
            $key = array_keys($ret);
            if($ret[0] == $file)
            {
                return $ret; 
            }
        
        }
        
    }
    
    public function loadCache($file)
    {
        $res = $this->getCacheName($file);
        
        if(!empty($res))
        {
            return $this->main_cache.$res[1];
        }
    }
    
    private function deleteCache($file,$map=array())
    {
        if(empty($map))
        {
            $map = $this->getCacheName($file);
        }
        
        $filename = array_keys($map);
        $cachename = $map[$filename];
        
       $path = $this->cache_map.$this->main_cache_map;
       
       $info = file_get_contents($path);
       
       $info = str_replace($filename."=".$cachename, '', $info);
       
       file_put_contents($path, $info);
        
    }
}
