<?php


class AdminController extends AController {

    function index() {

        $this->render('index');
    }

    function news() {

        $cate = Cate::model()->find('alias = ?', array ('news'));
        $this->render('content', array ('cate' => $cate));
    }

    function cate() {
        $this->render('cate');
    }

    function manage(){
        $cate = Cate::model()->find('alias = ?', array ('manage'));
        $this->render('content', array ('cate' => $cate));
    }

    function adopt(){
        $cate = Cate::model()->find('alias = ?', array ('adopt'));
        $this->render('content', array ('cate' => $cate));
    }

    function live(){
        $cate = Cate::model()->find('alias = ?', array ('live'));
        $this->render('content', array ('cate' => $cate));
    }

    function donate(){
        $cate = Cate::model()->find('alias = ?', array ('donate'));
        $this->render('content', array ('cate' => $cate));
    }

    function medic(){
        $cate = Cate::model()->find('alias = ?', array ('medic'));
        $this->render('content', array ('cate' => $cate));
    }

}

