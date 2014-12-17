<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午3:32
 */
class CateList extends MDataProvider {

    protected function fetchData() {

        $pagination = $this->getPagination();
        $sqlOrder = $this->getOrderBy('cid desc');
        $sqlFilter = $this->getFilter();

        $sql = 'select
                *
            from ' . Cate::table() . '
            where
                delete_time is null and
                ' . $sqlFilter . ' ' .
            $sqlOrder . '
            limit ' . $pagination->getOffset() . ', ' . $pagination->getLimit() . '
        ';
        $list = Cate::getPrepare($sql)->findAll(array ());

        foreach ($list as $key => $one) {
            $one['primaryKey'] = "{$one['cid']}";
            $list[$key] = $one;
        }

        return $list;
    }

    protected function calculateTotalItemCount() {
        return 0;
    }
}
