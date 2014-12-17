<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:21
 */
class InfoForm extends MFormModel {

    public $name;
    public $contact;
    public $home;
    public $id_num;

    public function save() {

        if (!$this->validate()) {
            return false;
        }

        return true;
    }
} 
