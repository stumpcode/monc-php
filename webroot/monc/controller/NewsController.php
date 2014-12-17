<?php


class NewsController extends MController {

    public $layout = 'layout/inner';

    function index() {

        $cate = app()->cms->aliasCate('news');

        $this->render('/cms/index', array ('cate' => $cate));
    }

    function page() {

        $this->layout = 'layout/page';

        if (!$id = $this->get('id')) {
            throw new HttpException(404);
        }

        if (!$content = Content::model()->findByPk($id)) {
            throw new HttpException(404);
        }

        $this->render('page', array ('content' => $content));
    }
}

