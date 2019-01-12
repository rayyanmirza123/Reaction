<?php

class Postgresql {

  private $dbname;
  private $host;
  private $user;
  private $password;
  
  private $connection;
  
  public function __construct($db,$host,$user,$pass)
  {
  $this->dbname = $db;
  $this->host = $host;
  $this->user = $user;
  $this->password = $pass;
    
  $con = "host=".$this->host." dbname=".$this->dbname." user=".$this->user." password=".$this->password;
    
  $this->connection = pg_connect($con) or die('Could not connect: ' . pg_last_error()); 
    
  }
  
  public function Query($query)
  {
   $ret = array(); 
   $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $ret[] = $line;
   }
    
    return $ret;
  }

  
}
