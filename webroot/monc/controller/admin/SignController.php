<?php


class SignController extends MController {

    public $layout = 'layout/admin';

    function in() {

        Monc::import('monc.form.LoginForm');

        $model = new LoginForm();
        if ($this->isPost()) {
            $model->setAttributes($_POST['LoginForm']);
            if ($model->save()) {
                $this->redirect(url('/admin'));
            }
        }

        $this->render('in', array (
            'model' => $model
        ));
    }
}

