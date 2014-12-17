<?php

require('global.func.php');


class Monc {

    /**
     * @var App
     */
    private static $app;

    /**
     * @return App
     */
    public static function app() {

        return App::inst();
    }

    public static function end() {
        self::app()->end();
    }

    public static function import($path) {
        return self::app()->import($path);
    }

    public static function importlib($path) {
        if (is_string($path)) {
            return self::app()->import('monc.lib.' . $path);
        } else {
            foreach ($path as $key => $one) {
                $path[$key] = 'monc.lib.' . $one;
            }
            return self::app()->import($path);
        }
    }

    static function t($str) {
        $arr = require(MONC . DS . 'message' . DS . 'trans.php');
        $keys = array_keys($arr);
        $keysNew = array ();
        foreach ($keys as $key => $one) {
            $keysNew[] = "/^$one$/";
        }
        return preg_replace($keysNew, array_values($arr), $str);
    }
}


require_once(dirname(__FILE__) . DS . 'lib' . DS . 'MComponent.php');
require_once(dirname(__FILE__) . DS . 'lib' . DS . 'MMap.php');


class App extends MComponent {

    public $param;
    public $main;

    /**
     * @var MRequest
     */
    public $request;
    /**
     * @var MWebUser
     */
    public $user;
    /**
     * @var MWidgetFactory
     */
    public $widgetFactory;

    /**
     * @var MSession
     */
    public $session;

    /**
     * @var MFormatter
     */
    public $formatter;

    /**
     * @var MController
     */
    public $controller;

    /**
     * @var Cms
     */
    public $cms;

    public $charset = 'utf-8';

    public $import_path_param = array ();
    public $import = array ();

    private static $inst;

    function __construct() {
    }

    function import($path) {

        if (is_string($path)) {
            return $this->importPath($path);
        } else {
            foreach ($path as $one) {
                $this->importPath($one);
            }
        }
    }

    /**
     * @return App
     */
    static function inst() {

        if (!self::$inst) {
            self::$inst = new App();
        }
        return self::$inst;
    }

    function init() {

        $env = getEnvAS();
        $this->main =
        $main = require(dirname(__FILE__) . DS . 'config' . DS . $env . DS . 'main.php');
        $param = array ();
        if (isset($main['param'])) {
            $param = $main['param'];
        }
        $this->param = $param;

        require_once(MONC . 'autoload.php');

        $this->import(
            array (
                'monc.util.*',
                'monc.lib.*',
                'monc.lib.exception.*',
                'monc.comp.*',
                'monc.controller.*',
                'monc.model.*',
                'monc.view.*',
                'monc.lib.validator.*',
            )
        );

        $this->import(
            array (
                //'monc.lib.yii.*',
                //'monc.lib.yii.widgets.*',
                //'monc.lib.bootstrap.widgets.*',
                //'monc.lib.bootstrap.helpers.*',
                //'monc.lib.bootstrap.components.*',
            )
        );

        $this->session = new MSession();
        $this->session->open();

        $this->user = new MWebUser();
        $this->user->init();

        $this->formatter = new MFormatter();

        $this->cms = new Cms();
    }

    /**
     * @param $dbName
     * @return MDbConnection
     */
    function getDb($dbName) {
        return MDbConnection::getInstance($this->main[$dbName]);
    }

    function run() {

        ob_start();

        $request = $this->createRequest();
        $this->request = $request;


        $router = new MRouter($request);
        $action = $router->createAction();
        $this->controller = $action->controller;

        $action->run();

        ob_end_flush();
    }

    private function createRequest() {
        $request = new MRequest();
        return $request;
    }

    /**
     * @return MWidgetFactory
     */
    public function getWidgetFactory() {
        if (!$this->widgetFactory) {
            return $this->widgetFactory = new MWidgetFactory();
        }
        return $this->widgetFactory;
    }

    public function end() {
        exit(0);
    }

    protected function importPath($path) {

        // existed
        if (in_array($path, $this->import_path_param)) {
            return substr($path, strrpos($path, '.') + 1);
        }
        $this->import_path_param[] = $path;
        $path = MONC . '../' . str_replace('.', DIRECTORY_SEPARATOR, $path);
        if (substr($path, -1) == '*') {
            $path = substr($path, 0, strlen($path) - 1);
        } else {
            $path .= '.php';
        }

        if (!file_exists($path)) {
            //debug_print_backtrace();
            return;
            //throw new RuntimeException('no such path: ' . $path);
        }
        if (is_dir($path)) {
            $d = opendir($path);
            while ($file = readdir($d)) {
                is_file($path . $file) && !is_link($path . $file)
                && preg_match('/\.php$/', $file)
                && ($this->import[$file] = $path . $file);
            }
        } else {
            $file = substr($path, (strrpos($path, '/') + 1));
            $this->import[$file] = $path;
        }
        return substr($path, strrpos($path, '/') + 1, -4);
    }
}


return Monc::app();
