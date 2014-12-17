<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:21
 */
class CateForm extends MFormModel {

    public $cid;
    public $title;
    public $desc;
    public $alias;
    public $status;

    public function save() {

        if (!$this->validate()) {
            return false;
        }

        $model = new Cate();
        $model->setAttributes($this->getAttributes());
        !$model->pid && $model->pid = 0;

        if (!$model->save()) {
            $this->addErrors($model->getErrors());
            return false;
        }

        return true;
    }
} 
