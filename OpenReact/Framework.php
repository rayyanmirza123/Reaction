<?php

/* 
 *  Damn Straight now copying only buying.
 */

error_reporting(E_ALL);

require "/app/OpenReact/Framework/Node/ReactJs.php";
require "/app/OpenReact/Library/Database/Postgresql.php";

$registry = new Registry();
$config = new Config();
$react = new ReactJS();

$babel = new ReactCompiler();

$document = new Document();

$document->addCss('../Admin/css/custom.css');

$document->addJs('../Admin/js/react.js');
$document->addJs('../Admin/js/babel.js');
$document->addJs('../Admin/js/react-dom-server.js');
$document->addJs('../Admin/js/react-dom.js');
$document->addJs('../Admin/js/create-react-class.js');
$document->addJs('../Admin/js/react_bundle.js');
$document->addJs('../Admin/js/main.jsx');

$view = new View($service);

$config->load($service);
$registry->set('config',$config);
$registry->set('document',$document);

$cache = new MainCache($registry);

$registry->set('view',$view);
$loader = new Loader($registry);
$registry->set('cache',$cache);

$user = $config->get('db_user');
$pass = $config->get('db_password');
$name = $config->get('db_name');
$host = $config->get('db_host');

$pg_database = new Postgresql($name,$host,$user,$pass);

$registry->set('load',$loader);
$registry->set('request',new Request());
$registry->set('react',$react);
$registry->set('compiler',$babel);
$registry->set('database',$pg_database);

$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('response_compression'));
$registry->set('response',$response);


$default = $config->get('default');
$registry->get('load')->controller($default);
