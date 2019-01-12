<?php

/* 
 *  Damn Straight now copying only buying.
 */



require 'Engine/Registry.php';
require 'Engine/Controller.php';
require 'Engine/Action.php';
require 'Engine/Config.php';
require 'Engine/Loader.php';

function Library($class)
{
    // Testing purpose
    $file = "OpenReact/Library/".str_replace('\\', '/', $class).".php";
    if(is_file($file))
    {
        include_once($file);
        return true;
    }
 else {
 new \Exception("Error loading class $class");       
 }
}


function Framework($class)
{
   // Testing purpose
 $file = "OpenReact/Framework/".str_replace('\\', '/', $class).".php";
    if(is_file($file))
    {
        include_once($file);
        return true;
    }
 else {
 new \Exception("Error loading class $class");       
 }   
}

function Node($class)
{
    // Testing purpose
    $file = "OpenReact/Framework/Node/".str_replace('\\', '/', $class).".php";
    if(is_file($file))
    {
        include_once($file);
        return true;
    }
 else {
 new \Exception("Error loading class $class");       
 }
}

function Cache($class)
{
    // Testing purpose
    $file = "OpenReact/Library/Cache/".str_replace('\\', '/', $class).".php";
    if(is_file($file))
    {
        include_once($file);
        return true;
    }
 else {
 new \Exception("Error loading class $class");       
 }
}
spl_autoload_register('Library');
spl_autoload_register('Framework',true);
spl_autoload_register('Node',true);
spl_autoload_register('Cache',true);

spl_autoload_extensions('.php');

//set Registry;
function Start($service)
{
   require 'Framework.php';
}
