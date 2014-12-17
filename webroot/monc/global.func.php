<?php
/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/21
 * Time: 上午8:54
 */


function dump($object) {
    var_dump($object);
}

function getEnvAS() {

    $envArr = require(dirname(__FILE__) . '/config/env.php');

    if (isset($envArr[gethostname()])) {
        return $envArr[gethostname()];
    } else {
        return 'online';
    }
}

function param($name) {

    $ar = explode('.', $name);
    $params = Monc::app()->param;

    foreach ($ar as $one) {

        if (isset($params[$one])) {
            $params = $params[$one];
        } else {

            return null;
        }
    }

    return $params;
}

function println($msg, $break = '<br/>') {
    echo $msg, $break;
}

function url($path, $param = array ()) {
    return Monc::app()->request->url($path, $param);
}

function curl($path, $param = array ()) {

    if (strpos($path, '/') === 0) {
        return url($path, $param);
    }

    $controller = Monc::app()->controller;
    $cid = $controller->id;
    if (!$path) {
        $aid = MRouter::ACTION_DEFAULT;
    } else {
        $aid = $path;
    }
    $mid = $controller->module ? $controller->module->id : '';
    $arr = array ();
    $mid && $arr[] = $mid;
    $cid && $arr[] = $cid;
    $aid && $arr[] = $aid;
    return url('/' . implode('/', $arr), $param);
}


function t($str) {
    return Monc::t($str);
}

function ta($arr) {

    return array_map(function ($one) {
        return t($one);
    }, $arr);
}

/**
 * @return App
 */
function app() {
    return Monc::app();
}


function now(){
    return date('Y-m-d H:i:s');
}

function today(){
    return date('Y-m-d');
}
