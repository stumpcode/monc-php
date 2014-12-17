<?php


class Alibaba_Cache_Entry {
    protected $connect = null;
    private $cache_alias_maps = array ();
    private $path;

    public function __construct() {
        $this->path = ALISDK_PATH . DIRECTORY_SEPARATOR .
            "tmp" . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR;
    }

    public function prepare($params) {
        if (isset($params[0])) {
            $cache_alias = $params[0];
            if (is_numeric($cache_alias)) {
                $cache_alias = strval($cache_alias);
            }
        } else {
            $cache_alias = 'ocs';
        }

        $dir = $this->getPath();
        if (false == @is_dir($dir)) {
            @mkdir($dir, 0700, true);
        }
        return $this;
    }

    public function get($keys) {
        if (is_numeric($keys)) {
            $keys = strval($keys);
        }
        if (is_array($keys)) {
            $rows = array ();
            foreach ((array) $keys as $key) {
                $rows[$key] = $this->get($key);
            }
            return $rows;
        } elseif (is_string($keys)) {
            $file = $this->getPath($keys);
            if (@is_file($file)) {
                return include $file;
            } else {
                return false;
            }
        }
        return false;
    }

    public function set($key, $var, $expire = null) {
        $file = $this->getPath($key);
        $str = "<?php ";
        if (false == is_null($expire)) {
            if ($expire < time()) {
                $expire += time();
                $str .= "if(time() > {$expire}){unlink (__FILE__); return false;}";
            }
        }
        $str .= "return ";
        if (is_array($var)) {
            $str .= var_export($var, true);
        } else {
            $str .= "'{$var}'";
        }
        $str .= ';';
        return file_put_contents($file, $str);
    }

    public function add($key, $var, $expire = null) {
        if ($this->get($key))
            return false;
        return $this->set($key, $var, $expire);
    }

    public function replace($key, $var, $expire = null) {
        return $this->set($key, $var, $expire);
    }

    public function delete($key) {
        $file = $this->getPath($key);
        if (file_exists($file))
            @unlink($file);
        return true;
    }

    public function decrement($key, $val = 1) {
        $data = $this->get($key);
        $rs = intval($data) - $val;
        $this->set($key, $rs);
        return $rs;
    }

    public function increment($key, $val = 1) {
        $data = $this->get($key);
        $rs = intval($data) + $val;
        $this->set($key, $rs);
        return $rs;
    }

    public function close() {
        return true;
    }

    private function getPath($key = null) {
        $path = $this->path;
        if (!empty($key)) {
            $path .= $key;
        }
        return $path;
    }
}
