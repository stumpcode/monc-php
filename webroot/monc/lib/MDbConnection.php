<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/2
 * Time: 上午1:32
 */
class MDbConnection extends MComponent {

    /**
     * @var PDO
     */
    public $pdo;

    static $dbList = array ();

    static function getInstance($opts) {

        if (isset(self::$dbList[$opts['dsn']])) {
            return self::$dbList[$opts['dsn']];
        }
        $db = new MDbConnection();
        $option = array_slice($opts, 3);
        $db->pdo = new PDO($opts['dsn'], $opts['user'], $opts['password'], $option);
        return self::$dbList[$opts['dsn']] = $db;
    }
}
