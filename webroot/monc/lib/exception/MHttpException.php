<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/2
 * Time: 上午2:23
 */
class MHttpException extends RuntimeException {
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        if ($code == 0 && is_numeric($message)) {
            $code = $message;
            parent::__construct($message, $code, $previous);
        }
    }
}
