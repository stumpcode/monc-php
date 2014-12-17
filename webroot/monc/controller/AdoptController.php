<?php


class AdoptController extends MController {

    public $layout = 'layout/inner';

    function index() {

        $cate = app()->cms->aliasCate('adopt');

        $this->render('/cms/index', array ('cate' => $cate));
    }
}

