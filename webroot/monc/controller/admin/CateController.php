<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午6:14
 */
class CateController extends AController {

    function create() {

        $model = new Cate();
        if ($this->isPost()) {
            $model->setAttributes($this->post('Cate'));
            if ($model->save()) {
                $this->redirect(url('/admin/cate'));
            }
        }

        $this->render('create', array (
            'model' => $model,
        ));
    }

    function update() {

        if (!$id = $this->get('id', 0)) {
            throw new MHttpException(404);
        }
        if (!$model = Cate::model()->findByPk($id)) {
            throw new MHttpException(404);
        }

        if ($this->isPost()) {
            $model->setAttributes($this->post('Cate'));
            if ($model->save()) {
                $this->redirect(url('/admin/cate'));
            }
        }

        $this->render('update', array (
            'model' => $model,
        ));
    }

    function view() {
        if (!$id = $this->get('id', 0)) {
            throw new MHttpException(404);
        }
        if (!$model = Cate::model()->findByPk($id)) {
            throw new MHttpException(404);
        }

        $this->render('view', array (
            'model' => $model,
        ));
    }

    function delete() {
        if (!$id = $this->get('id', 0)) {
            throw new MHttpException(404);
        }
        if (!$model = Cate::model()->findByPk($id)) {
            throw new MHttpException(404);
        }

        if ($model->delete()) {
            $this->renderCode(0, '');
        } else {
            $this->renderCode(1, 'fail to delete');
        }
    }
} 
