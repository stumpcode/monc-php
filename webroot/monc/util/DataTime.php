<?php


class DataTime {

    public $beginDate;
    public $endDate;

    function __construct($beginDate = null, $endDate = null) {
        $this->beginDate = $beginDate ? $beginDate : date('Y-m-d', strtotime('-7 day'));
        $this->endDate = $endDate ? $endDate : date('Y-m-d');
    }

    function listDate() {
        $tb = strtotime($this->beginDate);
        $te = strtotime($this->endDate);

        $arr = array ();
        while ($tb <= $te) {
            $arr[] = date('Y-m-d', $tb);
            $tb = strtotime('+1 day', $tb);
        }
        return $arr;
    }
}
