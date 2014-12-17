<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/14
 * Time: 上午10:25
 */
class AController extends MController {

    public $layout = 'layout/admin';

    function beforeAction($action) {
        //dump($this->user->id);die;
        if (!$this->user->id) {
            $this->redirect('/admin/sign/in');
        }
    }
}
