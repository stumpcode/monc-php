<?php

class MedicController extends MController {

    public $layout = 'layout/inner';

    function index() {

        $cate = app()->cms->aliasCate('medic');

        $this->render('/cms/index', array ('cate' => $cate));
    }
}

