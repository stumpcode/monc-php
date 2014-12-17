<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/14
 * Time: 上午10:02
 * @property int pid
 * @property mixed cid
 */
class Cate extends MDbModel {

    public static $table = 'cate';

    /**
     * @return Cate
     */
    static function getNewsCate() {
        return Cate::model()->find('alias = ?', arrary('news'));
    }
}
