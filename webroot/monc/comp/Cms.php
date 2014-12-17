<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/16
 * Time: 上午1:39
 */
class Cms extends MComponent {

    /**
     * @param $cateAlias
     * @param $contentAlias
     * @return Content
     */
    function aliasContent($cateAlias, $contentAlias) {

        if (!$cate = Cate::model()->find('alias = ?', array ($cateAlias))) {
            return;
        }
        return Content::model()->find('alias = :alias and cid = :cid and delete_time is null ',
            array (':alias' => $contentAlias, ':cid' => $cate->cid));
    }

    /**
     * @param $cateAlias
     * @return Cate
     */
    function aliasCate($cateAlias) {

        return Cate::model()->find('alias = ? and delete_time is null', array ($cateAlias));
    }

    function aliasList($cateAlias = null, $contentAlias = null, $limit = 10) {

        $pagination = new MPagination();
        $pagination->setPageSize($limit);
        $pagination->setCurrentPage(0);

        if (is_null($cateAlias)) {
            return Content::model()->findAll('delete_time is null ',
                array (), $pagination, ' content_id desc ');
        }

        if (!$cate = Cate::model()->find('alias = ?', array ($cateAlias))) {
            return;
        }
        if (is_null($contentAlias)) {
            return Content::model()->findAll('cid = :cid and delete_time is null ',
                array (':cid' => $cate->cid), $pagination, ' content_id desc ');
        }

        return Content::model()->findAll('alias = :alias and cid = :cid ',
            array (':alias' => $contentAlias, ':cid' => $cate->cid), $pagination,
            ' content_id desc ');
    }

} 
