<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午3:32
 */
class ContentList extends MDataProvider {

    /**
     * @var Cate
     */
    public $cate;

    function __construct($cate) {

        $this->cate = $cate;
    }

    protected function fetchData() {

        $pagination = $this->getPagination();
        $sqlOrder = $this->getOrderBy('content_id desc');
        $sqlFilter = $this->getFilter();

        $sql = 'select
                *
            from ' . Content::table() . '
            where
                delete_time is null and
                cid = :cid and
                ' . $sqlFilter . ' ' .
            $sqlOrder . '
            limit ' . $pagination->getOffset() . ', ' . $pagination->getLimit() . '
        ';
        $list = Content::getPrepare($sql)->findAll(array (
            ':cid'=>$this->cate->cid
        ));

        foreach ($list as $key => $one) {
            $one['primaryKey'] = "{$one['content_id']}";
            $list[$key] = $one;
        }

        return $list;
    }

    protected function calculateTotalItemCount() {

        $sqlFilter = $this->getFilter();

        $sql = 'select count(1)
            from ' . Content::table() . '
            where
                delete_time is null and
                cid = :cid and
                ' . $sqlFilter . '
        ';
        return Content::getPrepare($sql)->queryScala(array (
            ':cid'=>$this->cate->cid
        ));
    }
}
