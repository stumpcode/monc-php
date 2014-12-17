<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:21
 */
class NewsForm extends ContentForm {

    public function save() {

        $this->cateid = Cate::getNewsCate();

        return parent::save();
    }
} 
