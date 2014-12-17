<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/28
 * Time: 下午6:48
 */
class MSession extends MComponent {

    private $cache;
    public $timeout = 86400;

    function __constructor() {

        $this->cache = Alibaba::Cache();

        session_set_save_handler(
            array ($this, 'openSession'),
            array ($this, 'closeSession'),
            array ($this, 'readSession'),
            array ($this, 'writeSession'),
            array ($this, 'destroySession'),
            array ($this, 'gcSession'));
    }

    private function sessionPrefix() {
        return 'moncs_';
    }

    function set($id, $val) {
        $_SESSION[$this->sessionPrefix() . $id] = $val;
    }

    function get($id) {
        return isset($_SESSION[$this->sessionPrefix() . $id]) ?
            $_SESSION[$this->sessionPrefix() . $id] : null;
    }

    function open() {
        session_start();
    }

    function close() {
        if (session_id() != '') {
            session_write_close();
        }
    }

    function destroy() {
        if (session_id() !== '') {
            session_unset();
            session_destroy();
        }
    }

    function openSession() {
        return true;
    }

    function closeSession() {
        unset($this->cache);
        return true;
    }

    function readSession($id) {
        return $this->cache->get($id);
    }

    function writeSession($id, $value) {
        $this->cache->set($id, $value, $this->timeout);
        return true;
    }

    function destroySession($id) {
        $this->cache->delete($id);
        return true;
    }

    function gcSession() {
        return true;
    }
} 
