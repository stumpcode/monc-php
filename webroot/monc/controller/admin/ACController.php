<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午6:14
 */
class ACController extends AController {

    public $cate;

    function beforeAction($action) {
        $this->cate = Cate::model()->findByPk($this->get('cid'));
        return parent::beforeAction($action);
    }

    public function getCateId() {
        return $this->cate->cid;
    }

    function create() {

        $model = new Content();
        $model->cid = $this->getCateId();
        $model->status = MDbModel::STATUS_ONLINE;
        $model->uid = $this->user->id;

        if ($this->isPost()) {

            if ($content = $this->post('Content.content')) {
                $model->content = htmlentities($content);
                unset($_POST['Content']['content']);
            }
            $model->setAttributes($this->post('Content'));

            if ($model->save()) {
                $this->redirect(url('/admin/' . $this->cate->alias));
            }
        }

        $this->render('../content/create', array (
            'model' => $model,
        ));
    }

    function update() {

        if (!$id = $this->get('id', 0)) {
            throw new MHttpException(404);
        }
        if (!$model = Content::model()->findByPk($id)) {
            throw new MHttpException(404);
        }

        if ($this->isPost()) {
            if ($content = $this->post('Content.content')) {
                $model->content = htmlentities($content);
                unset($_POST['Content']['content']);
            }
            $model->setAttributes($this->post('Content'));
            if ($model->save()) {
                $this->redirect(url('/admin/' . $this->cate->alias));
            }
        }

        $this->render('../content/update', array (
            'model' => $model,
        ));
    }

    function view() {
        if (!$id = $this->get('id', 0)) {
            throw new MHttpException(404);
        }
        if (!$model = Content::model()->findByPk($id)) {
            throw new MHttpException(404);
        }

        $this->render('../content/view', array (
            'model' => $model,
        ));
    }

    function delete() {
        if (!$id = $this->get('id', 0)) {
            throw new MHttpException(404);
        }
        if (!$model = Content::model()->findByPk($id)) {
            throw new MHttpException(404);
        }

        if ($model->delete()) {
            $this->renderCode(0, '');
        } else {
            $this->renderCode(1, 'fail to delete');
        }
    }
}
