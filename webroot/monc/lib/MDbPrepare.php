<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午5:27
 */
class MDbPrepare {

    /**
     * @var PDoStatement
     */
    private $pdoStatement;

    /**
     * @param $pdoStatement
     */
    function __construct($pdoStatement) {
        $this->pdoStatement = $pdoStatement;
    }

    function findAll($params) {

        $statement = $this->pdoStatement;
        if (!$statement->execute($params)) {

            throw new MDbException("[" . $statement->errorCode() . "]" .
                $statement->queryString . "\r\n" .
                print_r($statement->errorInfo(), 1) . "\r\n" . print_r($params, 1));
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($params) {

        $statement = $this->pdoStatement;
        if (!$statement->execute($params)) {

            throw new MDbException("[" . $statement->errorCode() . "]" .
                $statement->queryString . "\r\n" .
                print_r($statement->errorInfo(), 1) . "\r\n" . print_r($params, 1));
        }
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function execute($params) {
        $statement = $this->pdoStatement;
        if (!$statement->execute($params)) {
            throw new MDbException("[" . $statement->errorCode() . "]" .
                $statement->queryString . "\r\n" .
                print_r($statement->errorInfo(), 1) . "\r\n" . print_r($params, 1));
        }
        return true;
    }

    function queryScala($params){
        $statement = $this->pdoStatement;
        if (!$statement->execute($params)) {
            throw new MDbException("[" . $statement->errorCode() . "]" .
                $statement->queryString . "\r\n" .
                print_r($statement->errorInfo(), 1) . "\r\n" . print_r($params, 1));
        }
        return $statement->fetch(PDO::FETCH_COLUMN);
    }
}
