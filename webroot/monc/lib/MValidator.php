<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/1
 * Time: 上午12:17
 */
class MValidator extends MComponent{

    public static $builtInValidators = array (
        'required' => 'CRequiredValidator',
        'filter' => 'CFilterValidator',
        'match' => 'CRegularExpressionValidator',
        'email' => 'CEmailValidator',
        'url' => 'CUrlValidator',
        'unique' => 'CUniqueValidator',
        'compare' => 'CCompareValidator',
        'length' => 'CStringValidator',
        'in' => 'CRangeValidator',
        'numerical' => 'CNumberValidator',
        'captcha' => 'CCaptchaValidator',
        'type' => 'CTypeValidator',
        'file' => 'CFileValidator',
        'default' => 'CDefaultValueValidator',
        'exist' => 'CExistValidator',
        'boolean' => 'CBooleanValidator',
        'safe' => 'CSafeValidator',
        'unsafe' => 'CUnsafeValidator',
        'date' => 'CDateValidator',
    );

    static function createValidator($attributes, $object, $validateName, $params) {

        switch ($validateName) {
            default:
                if (isset(self::$builtInValidators[$validateName])) {
                    return new self::$builtInValidators[$validateName]();
                }
        }
        return;
    }
} 
