<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/14
 * Time: 上午10:14
 * @property mixed id
 */
class MWebUser extends MComponent {

    /**
     * @var MSession
     */
    public $session;

    /**
     * 1. sessionid
     * 2. name
     */
    function init() {
        $this->session = Monc::app()->session;
    }

    function login() {
        $this->id = 1;
        $this->name = 'admin';
    }

    function setId($id) {
        $this->session->set('__id', $id);
    }

    function getId() {
        return $this->session->get('__id');
    }

    function setName($name) {
        $this->session->set('__name', $name);
    }

    function getName() {
        return $this->session->get('__name');
    }

    function setState($key, $value) {
        $this->session->set($key, $value);
    }

    function getState($key) {
        return $this->session->get($key);
    }
}
