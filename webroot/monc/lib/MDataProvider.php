<?php


/**
 * Created by IntelliJ IDEA.
 * provide the admin data provider, just like yii data provider
 * User: apple
 * Date: 14/12/7
 * Time: 下午3:32
 */
abstract class MDataProvider extends MComponent {

    private $_attributes;
    private $_pagination;
    private $dataTimeFilter = array ();
    private $attrs;

    /**
     * @var DataTime
     */
    public $dataTime;

    function setAttributeNames($attributes) {
        $this->_attributes = $this->trans($attributes);
    }

    function attributeNames() {

        if (!$this->_attributes) {

            if(!$this->getData()){
                return array();
            }
            $row = current($this->getData());
            if (!$row) {
                return array ();
            }
            $keys = array_keys($row);

            $this->_attributes = $this->trans($keys);
        }
        return $this->_attributes;
    }

    function trans($keys) {
        $attr = array ();
        foreach ($keys as $key) {
            $brr = explode('_', $key);
            $crr = array ();
            foreach ($brr as $one) {
                $crr[] = ucfirst($one);
            }
            $attr[$key] = implode($crr, ' ');
        }
        return ta($attr);
    }


    public function getPagination() {
        if ($this->_pagination === null) {
            $this->_pagination = new MPagination();
            if (($id = $this->getId()) != '')
                $this->_pagination->pageVar = $id . '_page';
            $this->_pagination->setItemCount($this->getTotalItemCount());
            $this->_pagination->setPageSize(app()->controller->get($id . '_page_limit'), 10);
        }
        return $this->_pagination;
    }

    public function getId() {
        return get_class($this);
    }

    public function getSort() {
        $sort = new MSort();
        $sort->model = $this;
        return $sort;
    }

    protected function getOrderBy($default, $ambiguity = array ()) {
        $sort = $this->getSort();

        $order = $sort->getOrderBy($ambiguity);

        $sqlOrder = $order ? 'order by ' . $order : ($default ? 'order by ' . $default : '');
        return $sqlOrder;
    }

    abstract protected function fetchData();

    protected function fetchKeys() {
        $keys = array ();
        foreach ($this->getData() as $i => $data) {
            $keys[$i] = $data['primaryKey'];
        }
        return $keys;
    }

    private $_data;

    public function getData() {
        if (!$this->_data) {
            $this->_data = $this->fetchData();
        }
        return $this->_data;
    }

    abstract protected function calculateTotalItemCount();

    function getFilter($ignore = array ()) {
        $arr = array ();
        if ($this->attrs) {
            foreach ($this->attrs as $key => $one) {
                if ($one === '')
                    continue;
                if (($pos = strpos($key, 'date_range')) !== false) {
                    $keyOri = substr($key, 0, $pos - 1);
                    $brr = explode(':', $one);
                    $start_date = isset($brr[0]) ? $brr[0] : '';
                    $end_date = isset($brr[1]) ? $brr[1] : '';
                    $dataTime = new DataTime($start_date, $end_date);
                    $start_date = $dataTime->beginDate;
                    $end_date = $dataTime->endDate;
                    $this->dataTimeFilter[$keyOri] = $dataTime;

                    // 先要注册到 dataFilter 中
                    if (in_array($keyOri, $ignore)) {
                        continue;
                    }

                    $arr[] = "{$keyOri} >= '{$start_date}' and {$keyOri} <= '{$end_date}'";
                    continue;
                }

                if (in_array($key, $ignore)) {
                    continue;
                }

                switch ($key) {
                    default:
                        $arr[] = "{$key} like '%{$one}%'";
                        break;
                }
            }
            if (!$arr) {
                return ' true ';
            }

            return ' ' . implode($arr, ' and ') . ' ';
        } else {
            return ' true ';
        }
    }

    private $_totalCnt;

    public function getTotalItemCount() {
        if (is_null($this->_totalCnt)) {
            $this->_totalCnt = $this->calculateTotalItemCount();
        }
        return $this->_totalCnt;
    }

}
