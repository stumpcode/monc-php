<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:21
 */
class ContentForm extends MFormModel {

    public $cid;
    public $title;
    public $cateid;
    public $content;
    public $alias;
    public $status;

    public function save() {

        if (!$this->validate()) {
            return false;
        }

        $model = new Content();
        $model->setAttributes($this->getAttributes());
        if (!$model->save()) {
            $this->addErrors($model->getErrors());
            return false;
        }

        return true;
    }
} 
