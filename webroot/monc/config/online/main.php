<?php

$main = require(dirname(__FILE__) . DS . '..' . DS . "main.php");

return MMap::mergeArray($main, array (

    'db' => array (
        'dsn' => 'mysql:host=[hostname];dbname=[dbname]',
        'user' => '[user]',
        'password' => '[pwd]',
        'charset' => 'utf-8',
    ),
));
