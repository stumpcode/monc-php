<?php

class DonateController extends MController {

    public $layout = 'layout/inner';

    function index() {

        $cate = app()->cms->aliasCate('donate');

        $this->render('/cms/index', array ('cate' => $cate));
    }
}

