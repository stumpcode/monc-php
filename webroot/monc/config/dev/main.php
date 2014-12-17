<?php

$main = require(dirname(__FILE__) . DS . '..' . DS . "main.php");

return MMap::mergeArray($main, array (

    'db' => array (
        'dsn' => 'mysql:host=localhost;dbname=monc-php',
        'user' => 'root',
        'password' => '123',
        'charset' => 'utf-8',
    ),
));
