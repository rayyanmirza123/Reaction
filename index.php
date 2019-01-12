<?php

/* 
 *  Damn Straight now copying only buying.
 */

$route = filter_input(INPUT_SERVER,'REQUEST_URI');
$route = urldecode($route);
if(isset($_GET))
{
 print_r($_GET); 
}
header('Location: /Admin/index.php?route='.$route);
