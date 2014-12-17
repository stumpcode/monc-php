<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:21
 */
class LoginForm extends MFormModel {

    public $name;
    public $password;

    public function save() {

        if(!$this->name == 'admin'){
            $this->addError('name', 'name error');
            return false;
        }

        if(!$this->password == 'admin'){
            $this->addError('password', 'pwd error');
            return false;
        }

        Monc::app()->user->login();
        return true;
    }
} 
