<?php
define('ALISDK_PATH', __DIR__);

class Alibaba
{
    static private $singletons = array();
    public static function __callStatic($method, $params)
    {
        return self::call($method, $params);
    }

    public static function call($method, $params)
    {
        $class = strtolower('Alibaba_' . $method . '_Entry');
        if (false === isset(self::$singletons[$class])) {
            include  ALISDK_PATH . DIRECTORY_SEPARATOR . strtolower($method) . DIRECTORY_SEPARATOR . "entry.php";
            self::$singletons[$class] = new $class;
        }
        if (method_exists(self::$singletons[$class], 'prepare')) {
            return self::$singletons[$class]->prepare($params);
        }
        return self::$singletons[$class];
    }
}

