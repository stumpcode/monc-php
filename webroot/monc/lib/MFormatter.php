<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/8
 * Time: 上午9:11
 */
class MFormatter {

    function format($type, $value, $options = array ()) {

        $method = 'format' . $type;
        if (!$type or !method_exists($this, $method)) {
            throw new RuntimeException('no method for type [' . $type . ']');
        }
        return $this->$method($value, $options);
    }

    function formatContentPreview($value, $options = array ()) {
        !isset($options['beg']) && $options['beg'] = 100;
        !isset($options['limit']) && $options['limit'] = 100;

        $value = strip_tags(html_entity_decode($value));
        if(mb_strlen($value) > $options['limit']){
            return mb_substr($value, 0, $options['limit'], 'utf-8'). '...';
        }
        return $value;
    }

    function formatDate($value, $options = array ()) {
        return date('Y-m-d', strtotime($value));
    }

    function formatStatus($value, $options = array ()) {
        return MDbModel::statusName($value);
    }

    function formatImage($value, $options = array ()) {
        $width = isset($options['width']) ? 'width=' . $options['width'] : '';
        return "<img src='{$value}' {$width} >";
    }

    function formatImage100($value, $options = array ()) {
        $width = isset($options['width']) ? $options['width'] : 100;
        return "<img src='{$value}' width='$width' >";
    }

    function formatImage50($value, $options = array ()) {
        $width = isset($options['width']) ? $options['width'] : 50;
        return "<img src='{$value}' width='$width' >";
    }

    function formatDbHtml($value, $options = array ()) {
        return html_entity_decode($value);
    }
}
