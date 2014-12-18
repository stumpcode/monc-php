<?php


class MHtml {

    public static function javascript($src) {
        $src = param('res') . (0 !== strpos($src, '/') ? '/' : '') . $src;
        return "<script type='text/javascript' src='{$src}'></script>";
    }

    public static function css($src) {
        $src = param('res') . (0 !== strpos($src, '/') ? '/' : '') . $src;
        return "<link rel='stylesheet' type='text/css' href='{$src}' />";
    }

    public static function res($src) {
        return param('res') . (0 !== strpos($src, '/') ? '/' : '') . $src;
    }

    static function activeTextField($model, $attribute, $htmlOptions = array ()) {
        return self::activeInputField('text', $model, $attribute, $htmlOptions);
    }

    static function activePasswordField($model, $attribute, $htmlOptions = array ()) {
        return self::activeInputField('password', $model, $attribute, $htmlOptions);
    }

    static function activeSwfUpload($model, $attribute, $htmlOptions = array ()) {

        return self::activeInputField('swfUpload', $model, $attribute, $htmlOptions);
    }

    static function activeTextAreaField($model, $attribute, $htmlOptions = array ()) {

        list($modelClass, $classL, $id, $class, $uniqid, $labelAttr, $value) =
            self::activeControlBefore($model, $attribute, $htmlOptions);

        !$id && $id = "form-control-{$uniqid}";

        return <<<eot
            <div class="form-group">
                <label class="{$classL}" for="{$id}">{$labelAttr}</label>
                <div class="form-control-wrapper {$class}">
                    <textarea class="form-control data-{$attribute}"
                          id="{$id}" name="{$modelClass}[{$attribute}]"
                        placeholder="{$labelAttr}" ">{$value}</textarea>
                </div>
            </div>
eot;
    }

    static function activeRadioList($model, $attribute, $values, $htmlOptions = array ()) {

        list($modelClass, $classL, $id, $class, $uniqid, $labelAttr, $value) =
            self::activeControlBefore($model, $attribute, $htmlOptions);

        $radioStr = '';
        foreach ($values as $key => $one) {
            $radioStr .= "\r\n" . '<div class="radio" style="display: inline-block;">
                        <label>
                            <input class=" data-preload" id="form-control-' . $uniqid . '"
                                ' . ($value == $key ? 'checked' : '') . '
                                value="' . $key . '" type="radio" name="' . $modelClass . '['
                . $attribute . ']">
                                ' . $one . '
                        </label>
                    </div>';
        }

        return <<<eot
            <div class="form-group">
                <label class="{$classL}" for="{$id}">{$labelAttr}</label>
                <div class="form-control-wrapper {$class}">
                    {$radioStr}
                </div>
            </div>
eot;
    }

    static function activeInputField($type, $model, $attribute, $htmlOptions) {

        list($modelClass, $classL, $id, $class, $uniqid, $labelAttr, $value) =
            self::activeControlBefore($model, $attribute, $htmlOptions);

        switch ($type) {
            case 'swfUpload':

                $extra = self::swfUpload($htmlOptions);
                $type = 'hidden';

                break;
            default:
                $extra = '';
                break;
        }

        return <<<eot
            <div class="form-group">
                <label class="{$classL}" for="{$id}">{$labelAttr}</label>
                <div class="form-control-wrapper {$class}">
                    <input class="form-control data-{$attribute}"
                          id="form-control-{$uniqid}" name="{$modelClass}[{$attribute}]"
                          value="{$value}"
                        placeholder="{$labelAttr}" type="{$type}">
                    {$extra}
                </div>
            </div>
eot;
    }

    static function id($model, $attr) {
        $c = get_class($model);
        return preg_replace('/Model$/', '', $c) . '-' . $attr;
    }

    static function encode($str) {
        return htmlentities($str);
    }

    static function addCssClass($item, &$htmlOptions) {

        if (isset($htmlOptions['class'])) {
            $arr = explode(' ', $htmlOptions['class']);
            if (in_array($item, $arr)) {
                return $htmlOptions;
            }
            $arr[] = $item;

            $htmlOptions['class'] = implode(' ', $arr);
        } else {
            $htmlOptions['class'] = $item;
        }
        return $htmlOptions;
    }

    static function openTag($item, $htmlOptions) {

        $html = '<';
        $html .= $item . ' ' . self::renderAttributes($htmlOptions) . '>';
        return $html;
    }

    static $specialAttributes = array (
        'async' => 1,
        'autofocus' => 1,
        'autoplay' => 1,
        'checked' => 1,
        'controls' => 1,
        'declare' => 1,
        'default' => 1,
        'defer' => 1,
        'disabled' => 1,
        'formnovalidate' => 1,
        'hidden' => 1,
        'ismap' => 1,
        'loop' => 1,
        'multiple' => 1,
        'muted' => 1,
        'nohref' => 1,
        'noresize' => 1,
        'novalidate' => 1,
        'open' => 1,
        'readonly' => 1,
        'required' => 1,
        'reversed' => 1,
        'scoped' => 1,
        'seamless' => 1,
        'selected' => 1,
        'typemustmatch' => 1,
    );

    public static function renderAttributes($htmlOptions) {

        if ($htmlOptions === array ())
            return '';

        $html = '';

        foreach ($htmlOptions as $name => $value) {
            if (isset($specialAttributes[$name])) {
                if ($value) {
                    $html .= ' ' . $name;
                    if (self::$renderSpecialAttributesValue)
                        $html .= '="' . $name . '"';
                }
            } elseif ($value !== null)
                $html .= ' ' . $name . '="' . ($value) . '"';
        }

        return $html;
    }

    static $closeSingleTags = true;

    public static function tag($tag, $htmlOptions = array (), $content = false) {
        $html = '<' . $tag . self::renderAttributes($htmlOptions);
        if ($content === false)
            return $html . ' />';
        else
            return $html . '>' . $content . '</' . $tag . '>';
    }

    static function pagination(array $items, $htmlOptions = array ()) {

        if (!empty($items)) {

            $htmlOptions = self::addCssClass('pagination', $htmlOptions);

            $output = self::openTag('ul', $htmlOptions);
            foreach ($items as $itemOptions) {
                $options = MMap::getValue($itemOptions, 'htmlOptions', array ());
                if (!empty($options)) {
                    $itemOptions = MMap::mergeArray($options, $itemOptions);
                }
                $label = MMap::getValue($itemOptions, 'label', '');
                $url = MMap::getValue($itemOptions, 'url', false);
                $output .= self::paginationLink($label, $url, $itemOptions);
            }
            $output .= '</ul>';
            return $output;
        }
        return '';
    }

    public static function paginationLink($label, $url, $htmlOptions = array ()) {
        $linkOptions = MMap::getValue($htmlOptions, 'linkOptions', array ());
        if (MMap::getValue($htmlOptions, 'active', false)) {
            $label .= self::tag('span', array ('class' => 'sr-only'));
            $htmlOptions = self::addCssClass('active', $htmlOptions);
            $url = 'javascript:void(0)';
        }
        if (MMap::getValue($htmlOptions, 'disabled', false)) {
            $htmlOptions = self::addCssClass('disabled', $htmlOptions);
            $url = 'javascript:void(0)';
        }
        $content = self::link($label, $url, $linkOptions);
        return self::tag('li', $htmlOptions, $content);
    }

    public static function link($text, $url = '#', $htmlOptions = array ()) {
        if ($url !== false) {
            $htmlOptions['href'] = $url;
            if (isset($htmlOptions['disabled'])) {
                $htmlOptions['href'] = '#';
            }
        }
        return self::tag('a', $htmlOptions, $text);
    }

    /**
     * @param $htmlOptions
     * @return string
     */
    protected static function swfUpload($htmlOptions) {
        $class = isset($htmlOptions['class']) ? $htmlOptions['class'] : '';
        $style = isset($htmlOptions['style']) ? $htmlOptions['style'] : '';
        $swfUploadId = MMap::getValue($htmlOptions, 'swfUploadId');

        return "<div id='{$swfUploadId}' class='{$class}' $style='$style' >
                    <input type='button' class='swf-button' id='" . uniqid() . "' />
                </div>";
    }


    static function image($src, $width) {
        return "<img src='{$src}' width='{$width}' >";
    }

    /**
     * @param $model
     * @param $attribute
     * @param $htmlOptions
     * @return array
     */
    protected static function activeControlBefore($model, $attribute, $htmlOptions) {
        $modelClass = get_class($model);

        $controlOptions = MMap::getValue($htmlOptions, 'controlOptions');
        $labelOptions = MMap::getValue($htmlOptions, 'labelOptions');

        $classL = MMap::getValue($labelOptions, 'class');

        $id = MMap::getValue($htmlOptions, 'id');
        !$id && $id = self::id($model, $attribute);

        $class = MMap::getValue($controlOptions, 'class');
        $class .= ' ' . 'data-' . $class;

        $uniqid = uniqid();
        $labelAttr = $model->label($attribute);
        $labelAttr = t($labelAttr);

        $value = $model->$attribute;
        return array ($modelClass, $classL, $id, $class, $uniqid, $labelAttr, $value);
    }
}
