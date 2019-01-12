<?php

/* 
 *  Damn Straight now copying only buying.
 */

$route = filter_input(INPUT_SERVER,'REQUEST_URI');
$route = urldecode($route);
header('Location: /OpenReact/Admin/index.php?route='.$route);