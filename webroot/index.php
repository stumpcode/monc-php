<?php

require 'monc/global.php';

define('MONC', dirname(__FILE__) . DS . 'monc' . DS);
define('MONC_PLUGIN', dirname(__FILE__) . DS . 'plugin' . DS);


$app = require MONC . 'App.php';
$app->init();

$app->run();

