<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午7:49
 */
class MButton extends MComponent {

    public $template = '{view} {update} {delete}';
    public $opts;
    private $buttons = array ();
    /**
     * @var MGridView
     */
    public $grid;

    private $buttonView = array (
        'label' => '查看',
        'icon' => 'eye-open',
        'url' => 'curl("view", array("id"=>$data["primaryKey"]))',
    );
    private $buttonUpdate = array (
        'label' => '修改',
        'icon' => 'pencil',
        'url' => 'curl("update", array("id"=>$data["primaryKey"]))',
    );
    private $buttonDelete = array (
        'label' => '删除',
        'icon' => 'remove',
        'url' => 'curl("delete", array("id"=>$data["primaryKey"]))',
        'ajax' => true,
    );

    function __construct($opts) {

        $this->opts = $opts;
        $this->applyOptions($opts);

        $arr = explode(' ', $this->template);
        foreach ($arr as $v) {
            if (empty($v)) {
                continue;
            }
            $v = str_replace(array ('{', '}'), '', $v);

            $valButton = "button" . ucfirst($v);
            $brr = array ();
            if (isset($this->$valButton)) {
                $brr = array_merge($brr, $this->$valButton);
            }
            if (isset($opts[$v])) {
                $brr = array_merge($brr, $opts[$v]);
            }
            $this->buttons[$v] = $brr;
            if (isset($brr['ajax'])) {
                $this->parseConfirmButton($v);
            }
        }
    }

    function render($data) {

        $strButton = '';
        foreach ($this->buttons as $k => $v) {

            if (isset($v['ajax'])) {
                $href = " onclick='{$v['clickFunc']}.apply(this)' href = 'javascript:void(0);'
                    data-href='" . eval('return ' . $v['url'] . ';') . "'";
            } else {
                $href = "href='" . eval('return ' . $v['url'] . ';') . "'";
            }

            $strButton .= "
                <li>
                    <a {$href} > " .
                (isset($v['icon']) ? "<i class='glyphicon glyphicon-{$v['icon']}'></i> " : '')
                . "{$v['label']}</a>
                </li>
            ";
        }

        return <<<eot
            <td class='data-buttons'>
                <ul class='list-unstyled'>
                    {$strButton}
                </ul>
            </td>
eot;
    }

    function parseConfirmButton($id) {

        $button = $this->buttons[$id];
        if (!isset($this->buttons[$id]['click'])) {
            $confirmation = "if(!confirm(" . MJavaScript::encode(isset($button['confirm']) ?
                    $button['confirm'] : '确定执行？') . ")) return false;";

            $csrf = '';

            $after = 'function(){}';

            $funcNam = str_replace('-', '_', 'gridFunc' . $this->grid->id . $id);

            $this->buttons[$id]['click'] = <<<EOD
                function {$funcNam}() {
                    $confirmation
                    var th = this,
                        afterFunc = $after;
                    console.log('do confirm')
                    console.log(this)
                    jQuery('#{$this->grid->id}').yiiGridView('update', {
                        type: 'POST',
                        url: jQuery(this).data('href'),$csrf
                        success: function(data) {
                            jQuery('#{$this->grid->id}').yiiGridView('update');
                            afterFunc(th, true, data);
                        },
                        error: function(XHR) {
                            return afterFunc(th, false, XHR);
                        }
                    });
                    return false;
                }
EOD;
            $this->buttons[$id]['clickFunc'] = $funcNam;
            app()->controller->appendScript($funcNam, $this->buttons[$id]['click']);
        }
    }
}
