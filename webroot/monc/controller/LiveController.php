<?php

class LiveController extends MController {

    public $layout = 'layout/inner';

    function index() {

        $cate = app()->cms->aliasCate('live');

        $this->render('/cms/index', array ('cate' => $cate));
    }
}

