<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:21
 */
class FormForm extends MFormModel {

    public $pet_type;
    public $pet_sex;
    public $pet_now;
    public $pet_now_cnt;
    public $pet_now_type;
    public $pet_adult;
    public $pet_disability;
    public $pet_sterilize;
    public $sex;
    public $job;
    public $living;
    public $home_idea;
    public $when_pregnant;
    public $ok_return_visit;

    public function save() {

        if (!$this->validate()) {
            return false;
        }

        if (!$info = Monc::app()->user->getState('info')) {
            throw new RuntimeException('第二步的个人信息还没填写');
        }

        $model = new Request();
        $model->setAttributes($info);
        $model->setAttributes($this->getAttributes());
        if (!$model->save()) {
            $this->addErrors($model->getErrors());
            return false;
        }

        return true;
    }
} 
