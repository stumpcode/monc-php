<?php


class MComponent {

    protected $m = array ();

    function init() {

    }

    static function getInstance($opts) {
        throw new RuntimeException('please implement it');
    }

    function applyOptions($opts) {
        if($opts){
            foreach ($opts as $key => $one) {
                if (property_exists($this, $key)) {
                    $this->$key = $one;
                }
            }
        }
    }

    function __get($name) {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        if (!isset($this->m[$name])) {
            return null;
        }
        return $this->m[$name];
    }

    function __isset($name) {
        return isset($this->m[$name]);
    }

    function __set($name, $val) {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            return $this->$setter($val);
        }
        return $this->m[$name] = $val;
    }

    private $_errors = array ();

    public function hasErrors($attribute = null) {
        if ($attribute === null)
            return $this->_errors !== array ();
        else
            return isset($this->_errors[$attribute]);
    }

    public function getErrors($attribute = null) {
        if ($attribute === null)
            return $this->_errors;
        else
            return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : array ();
    }

    public function getError($attribute) {
        return isset($this->_errors[$attribute]) ? reset($this->_errors[$attribute]) : null;
    }

    public function addError($attribute, $error) {
        $this->_errors[$attribute][] = $error;
    }

    public function addErrors($errors) {
        foreach ($errors as $attribute => $error) {
            if (is_array($error)) {
                foreach ($error as $e)
                    $this->addError($attribute, $e);
            } else
                $this->addError($attribute, $error);
        }
    }

    public function clearErrors($attribute = null) {
        if ($attribute === null)
            $this->_errors = array ();
        else
            unset($this->_errors[$attribute]);
    }

    public function getErrorAsString($linebreak = "") {

        if (!$linebreak) {
            if (app()->request->isAjaxRequest) {
                $linebreak = "\r\n";
            } else {
                $linebreak = "<br/>";
            }
        }

        if (!$arr = $this->getErrors()) {
            return false;
        }

        $str = '';
        foreach ($arr as $key => $one) {
            $str .= "{$one[0]}" . $linebreak;
        }
        return $str;
    }

}
