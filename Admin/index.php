<?php

require_once('config.php');

if(is_file('../OpenReact/StartUp.php'))
{
    $service = 'admin';
    require_once('../OpenReact/StartUp.php');
    Start($service);
}
else
{
    echo 'OpenReact/StartUp.php';
    echo "<code>Hard Error Going Down</code>";
    echo "\n<b>Something is wrong with the installation or the config file you can manually fix it </b>";
}
