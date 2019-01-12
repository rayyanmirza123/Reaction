<?php

require_once('config.php');

if(is_file(DIR_WIN.'OpenReact\\StartUp.php'))
{
    $service = 'admin';
    require_once(DIR_WIN.'OpenReact\\StartUp.php');
    Start($service);
}
else
{
    echo DIR_WIN.'OpenReact\\StartUp.php';
    echo "<code>Hard Error Going Down</code>";
    echo "\n<b>Something is wrong with the installation or the config file you can manually fix it </b>";
}