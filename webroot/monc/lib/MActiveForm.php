<?php


class MActiveForm extends MWidget {

    const FORM_LAYOUT_VERTICAL = 'vertical';
    const FORM_LAYOUT_HORIZONTAL = 'horizontal';
    const FORM_LAYOUT_INLINE = 'inline';
    const FORM_LAYOUT_SEARCH = 'search';

    public $type;

    function __construct($type = self::FORM_LAYOUT_HORIZONTAL) {
        $this->type = $type;
    }

    const CLASS_LABEL = 'control-label col-sm-2';
    const CLASS_CONTROL = 'col-sm-10';

    function __call($name, $arguments) {

        if (!method_exists('MHtml', $name)) {
            throw new RuntimeException('no such method');
        }
        switch ($this->type) {
            case self::FORM_LAYOUT_INLINE:
                break;
            default:

                switch ($name) {
                    case 'activeRadioList':
                        $htmlOptionsIndex = 3;
                        break;
                    default:
                        $htmlOptionsIndex = 2;
                }
                if (!isset($arguments[$htmlOptionsIndex])) {
                    $arguments[$htmlOptionsIndex] = array ();
                }
                !isset($arguments[$htmlOptionsIndex]['inputOptions'])
                && $arguments[$htmlOptionsIndex]['inputOptions'] = array ();
                !isset($arguments[$htmlOptionsIndex]['inputOptions']['class'])
                && $arguments[$htmlOptionsIndex]['inputOptions']['class'] = '';
                !isset($arguments[$htmlOptionsIndex]['labelOptions'])
                && $arguments[$htmlOptionsIndex]['labelOptions'] = array ();
                !isset($arguments[$htmlOptionsIndex]['labelOptions']['class'])
                && $arguments[$htmlOptionsIndex]['labelOptions']['class'] = '';
                !isset($arguments[$htmlOptionsIndex]['controlOptions'])
                && $arguments[$htmlOptionsIndex]['controlOptions'] = array ();
                !isset($arguments[$htmlOptionsIndex]['controlOptions']['class'])
                && $arguments[$htmlOptionsIndex]['controlOptions']['class'] = '';

                false === strpos($arguments[$htmlOptionsIndex]['labelOptions']['class'], 'col-') ?
                    $arguments[$htmlOptionsIndex]['labelOptions']['class'] .= ' '
                        . self::CLASS_LABEL : null;
                $arguments[$htmlOptionsIndex]['labelOptions']['class'] .= ' control-label';

                false === strpos($arguments[$htmlOptionsIndex]['controlOptions']['class'],
                    'col-') ?
                    $arguments[$htmlOptionsIndex]['controlOptions']['class'] .= ' '
                        . self::CLASS_CONTROL : '';

                break;
        }
        return call_user_func_array('MHtml::' . $name, $arguments);
    }



    /**
     * @param $model MModel
     */
    function errorSummary($model) {

        if ($model->hasErrors()) {
        }
    }

} 
