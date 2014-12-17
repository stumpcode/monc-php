<?php
/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/2
 * Time: 上午1:53
 */

class Helper {

    static function transAttrLabel($attribute) {
        $arr = explode('_', $attribute);
        $brr = array ();
        foreach ($arr as $one) {
            $brr[] = ucfirst($one);
        }
        return implode(' ', $brr);
    }

    static function uuid($prefix = "") { //可以指定前缀
        $str = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8) . '-';
        $uuid .= substr($str, 8, 4) . '-';
        $uuid .= substr($str, 12, 4) . '-';
        $uuid .= substr($str, 16, 4) . '-';
        $uuid .= substr($str, 20, 12);
        return $prefix . $uuid;
    }

} 
