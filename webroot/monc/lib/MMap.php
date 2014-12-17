<?php


class MMap {

    /**
     * 数字特殊处理
     * @param $a
     * @param $b
     * @return array|mixed
     */
    public static function mergeArray($a, $b) {
        $args = func_get_args();
        $done = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $key => $val) {
                if (is_integer($key)) {
                    isset($done[$key]) ? $done[] = $val : $done[$key] = $val;
                } elseif (is_array($val) && isset($done[$key]) && is_array($done[$key])) {
                    $done[$key] = self::mergeArray($done[$key], $val);
                } else {
                    $done[$key] = $val;
                }
            }
        }
        return $done;
    }

    static function getValue($arr, $key, $default = '') {

        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return $default;
    }
}
