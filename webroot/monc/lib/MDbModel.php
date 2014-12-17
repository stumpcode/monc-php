<?php


/**
 * Class MMode
 * 处理连接，保存，后台队列，以及自动生成方案
 */
class MDbModel extends MModel {

    const STATUS_ONLINE = 100;
    const STATUS_OFFLINE = 101;
    const STATUS_DELETE = 102;

    static function statusName($status) {
        $arr = array (
            self::STATUS_ONLINE => '发布',
            self::STATUS_OFFLINE => '下线',
            self::STATUS_DELETE => '删除',
        );
        if (isset($arr[$status])) {
            return $arr[$status];
        }
        return $status;
    }


    public $primaryKey;
    public $primaryKeyField;

    public static $dbName = 'db';
    public static $table;
    /**
     * @var MDbConnection
     */
    public $db;

    public $isNew = true;

    static $attrs = array ();
    private static $tableInfo = array();

    public static function table() {
        return static::$table;
    }

    private $labels;

    public function labels() {
        if (!$this->labels) {
            $names = $this->attributeNames();
            $labels = array ();
            foreach ($names as $v) {
                $labels[$v] = $this->generateAttributeLabel($v);
            }
            $this->labels = $labels;
        }
        return $this->labels;
    }

    function __construct() {

        if (!isset(self::$tableInfo[static::$table])) {
            $this->db = app()->getDb(static::$dbName);

            $statement =
                $this->db->pdo->prepare('select * from information_schema.columns where table_name=:name');
            $statement->execute(array (
                ':name' => static::$table
            ));

            if (!$rs = $statement->fetchAll(PDO::FETCH_BOTH)) {
                throw new RuntimeException('no fields for table ' . static::$table);
            }

            self::$tableInfo[static::$table] = $rs;
        }

        foreach (self::$tableInfo[static::$table] as $one) {
            if ($one['COLUMN_KEY'] == 'PRI') {
                $this->primaryKeyField = $one['COLUMN_NAME'];
            }
        }
    }

    public function attributeNames() {

        if (isset(self::$attrs[static::$table])) {
            return self::$attrs[static::$table];
        }

        $arr = array ();
        foreach (self::$tableInfo[static::$table] as $one) {
            $arr[] = $one['COLUMN_NAME'];
        }

        return self::$attrs[static::$table] = $arr;
    }

    function save() {

        $this->db = app()->getDb(static::$dbName);

        $names = $this->attributeNames();

        // ----------  remove primary key  ----------

        $fields = array ();
        foreach ($names as $k => $v) {
            $k != $this->primaryKeyField ? $fields[$k] = $v : null;
        }

        // ----------  add ':' for params  ----------

        $fieldsParam = array_map(function ($value) {
            return ":$value";
        }, $fields);

        // ----------  fix the fields for sql   ----------

        $fieldsName = array_map(function ($v) {
            return "`$v`";
        }, $fields);

        $table = static::$table;

        if ($this->isNew) {

            $sql = "insert into {$table} (" .
                implode(',', $fieldsName) .
                ") values(" . implode(',', $fieldsParam) . ")";
        } else {
            $sql = "update {$table} set ";
            foreach ($fieldsName as $k => $v) {
                $sql .= "$v = " . $fieldsParam[$k] . ", ";
            }
            $sql = substr($sql, 0, strlen($sql) - 2);

            // add the where condition
            $sql .= ' ' . ' where ' . $this->primaryKeyField . ' = :' . $this->primaryKeyField;
            $fieldsParam[] = ':' . $this->primaryKeyField;
        }

        $arr = $this->getAttributes();
        $fieldsValue = array ();
        foreach ($arr as $key => $one) {
            if (in_array(":" . $key, $fieldsParam)) {
                if ($this->isNew) {
                    switch ($key) {
                        case 'create_time':
                        case 'update_time':
                            empty($one) && $one = now();
                            break;
                    }
                } else {
                    switch ($key) {
                        case 'update_time':
                            $one = now();
                            break;
                    }
                }
                $fieldsValue[$key] = $one;
            }
        }

        asort($fieldsParam);
        ksort($fieldsValue);
        $params = array_combine($fieldsParam, $fieldsValue);

        $statement =
            $this->db->pdo->prepare($sql);
        if (!$statement->execute($params)) {
            throw new MDbException("code[" . $statement->errorCode() . "] \r\n***********\r\n" .
                $statement->queryString . "\r\n***********\r\n" .
                print_r($statement->errorInfo(), 1) . "\r\n***********\r\n" . print_r($params, 1));
        }

        return true;
    }

    function delete() {
        $db = $this->getDb();

        $keyField = $this->primaryKeyField;
        $this->primaryKey = $this->$keyField;

        $sql = 'update ' . $this->table() . ' set delete_time = :delete_time where '
            . $this->primaryKeyField . ' = :' . $this->primaryKeyField;
        $prepare = new MDbPrepare($db->pdo->prepare($sql));
        return $prepare->execute(array (':delete_time' => now(),
            ':' . $this->primaryKeyField => $this->primaryKey));
    }

    /**
     * @return MDbConnection
     */
    static function getDb() {
        return app()->getDb(static::$dbName);
    }

    /**
     * @param $sql
     * @return MDbPrepare
     */
    static function getPrepare($sql) {
        return new MDbPrepare(self::getDb()->pdo->prepare($sql));
    }

    /**
     * @return MDbModel
     */
    static function model() {
        $class = get_called_class();
        return new $class();
    }

    /**
     * @param $condition
     * @param array $params
     * @param MPagination $pagination
     * @param $order
     * @return array
     */
    function findAll($condition, $params = array (), $pagination = null, $order = '') {

        $sqlOrder = $order ? 'order by ' . $order : '';

        if ($condition) {
            $condition = ' and ' . $condition;
        }

        $sqlLimit = '';
        if ($pagination) {
            // set count

            $sql = 'select count(1) from ' . static::$table . ' where 1 ' . $condition;

            $prepare = new MDbPrepare(self::getDb()->pdo->prepare($sql));
            if (!$cnt = $prepare->queryScala($params)) {
                return null;
            }
            $pagination->setItemCount($cnt);

            $sqlLimit = ' limit ' . $pagination->getOffset() . ', ' . $pagination->getLimit() . ' ';
        }

        $sql =
            'select * from ' . static::$table . ' where 1 ' . $condition . ' ' . $sqlOrder . ' '
            . $sqlLimit;
        $prepare = new MDbPrepare(self::getDb()->pdo->prepare($sql));
        if (!$list = $prepare->findAll($params)) {
            return null;
        }

        foreach ($list as $key => $one) {
            $model = self::model();
            $model->isNew = false;
            $model->setAttributes($one);
            $keyField = $model->primaryKeyField;
            $model->primaryKey = $model->$keyField;
            $list[$key] = $model;
        }

        return $list;
    }

    function find($condition, $params = array ()) {

        if ($condition) {
            $condition = ' and ' . $condition;
        }

        $sql = 'select * from ' . static::$table . ' where 1 ' . $condition;
        $prepare = new MDbPrepare(self::getDb()->pdo->prepare($sql));
        if (!$arr = $prepare->find($params)) {
            return null;
        }

        $this->isNew = false;
        $this->setAttributes($arr);
        $keyField = $this->primaryKeyField;
        $this->primaryKey = $this->$keyField;
        return $this;
    }

    function findByPk($id) {
        $sql = 'select * from ' . static::$table . ' where ' . $this->primaryKeyField . ' = ?';
        $prepare = new MDbPrepare(self::getDb()->pdo->prepare($sql));
        if (!$arr = $prepare->find(array ($id))) {
            return null;
        }

        $this->isNew = false;
        $keyField = $this->primaryKeyField;
        $this->primaryKey = $this->$keyField;
        $this->setAttributes($arr);
        return $this;
    }
}
