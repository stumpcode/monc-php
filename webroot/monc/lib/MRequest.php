<?php


class MRequest extends MComponent {

    public $uri;
    public $uriWithOutParams;

    function __construct() {
        $this->uri = $uri = $_SERVER['REQUEST_URI'];
        $this->uriWithOutParams =
            substr($uri, 0, strpos($uri, '?') !== false ? strpos($uri, '?') : strlen($uri));
    }

    public function get($key, $default = null) {
        $arr = explode('.', $key);
        if ($arr) {
            $curr = $_GET;
            foreach ($arr as $one) {
                if (!isset($curr[$one])) {
                    return $default;
                }
                $curr = $_GET[$one];
            }
        }
        return $curr;
    }

    public function post($key, $default = null) {
        $arr = explode('.', $key);
        if ($arr) {
            $curr = $_POST;
            foreach ($arr as $one) {
                if (!isset($curr[$one])) {
                    return $default;
                }
                $curr = $curr[$one];
            }
        }
        return $curr;
    }

    function url($path, $param = array ()) {

        $str = '';
        if ($param) {
            if (substr_count($path, '/') > 2 && strrpos($path, '/') != strlen($path)) {
                foreach ($param as $key => $one) {
                    $str .= "/$key/$one";
                }
            } else {
                if (false === strpos($path, '?')) {
                    $str .= '?';
                }
                $str1 = '';
                foreach ($param as $key => $one) {
                    $str1 .= "&$key=$one";
                }
                $str1 = substr($str1, 1);
                $str .= $str1;
            }
        }
        return $path . $str;
    }
}
