<?php

class ContextFilter {

private $context;
private $path;
private $request;

public function __construct($request)
{

}

private function pre_process_request($request)
{
    $parts = explode('/',$request);
}

}
