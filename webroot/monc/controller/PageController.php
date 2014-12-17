<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/16
 * Time: 上午1:45
 */
class PageController extends MController {

    function index() {

        $this->layout = 'layout/page';

        if (!$id = $this->get('id')) {
            throw new HttpException(404);
        }

        if (!$content = Content::model()->findByPk($id)) {
            throw new HttpException(404);
        }

        if (!$cate = Cate::model()->findByPk($content->cid)) {
            throw new HttpException(404);
        }

        $this->render('index', array ('content' => $content, 'cate' => $cate));
    }

} 
