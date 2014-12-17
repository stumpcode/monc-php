<?php


class FormController extends MController {

    public $layout = 'form/form_layout';

    function index() {
        $this->redirect(url('/form/step1'));
    }

    function step1() {
        $this->render('index');
    }

    function step2() {

        Monc::import('monc.form.InfoForm');
        $model = new InfoForm();

        if ($this->isPost()) {

            $model->setAttributes($this->post('InfoForm'));

            if ($model->save()) {
                $this->user->setState('info', $model->getAttributes());
                $this->redirect(curl('step3'));
            }
        } else {
            if ($data = $this->user->getState('info')) {
                $model->setAttributes($data);
            }
        }

        $this->render('info', array ('model' => $model));
    }

    function step3() {

        Monc::import('monc.form.FormForm');

        $model = new FormForm();

        if ($this->isPost()) {

            $model->setAttributes($this->post('FormForm'));

            if ($model->save()) {
                $this->user->setState('form', $model->getAttributes());
                $this->redirect(curl('step4'));
            }
        } else {
            if ($data = $this->user->getState('form')) {
                $model->setAttributes($data);
            }
        }

        $this->render('form', array ('model' => $model));
    }

    function step4() {
        $this->render('done');
    }


}

