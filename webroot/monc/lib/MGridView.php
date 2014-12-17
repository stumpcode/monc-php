<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午3:28
 */
class MGridView extends MComponent {

    /**
     * @var MDataProvider
     */
    private $model;
    private $opts = array ();
    private $columns = array ();
    /**
     * @var MButton
     */
    private $buttons;

    public function getId() {
        return get_class($this);
    }

    function __construct($opts) {

        if (!$model = MMap::getValue($opts, 'model')) {
            throw new Exception('no model for list display');
        }

        $this->model = $model;
        $this->opts = $opts;

        $columns = array ();
        if (isset($opts['columns'])) {
            foreach ($opts['columns'] as $k => $v) {

                if ('buttons' === $k) {
                    !$v && $v = array ();
                    $v = array_merge($v, array ('grid' => $this));
                    $this->buttons = new MButton($v);
                    continue;
                } else {
                    if (is_array($v)) {
                        $columns[$v[0]] = array_slice($v, 1);
                    } else {
                        $columns[$v] = array ();
                    }
                }
            }
        }
        $this->columns = $columns;

        $options = array (
            'url' => app()->controller->getRequest()->uri,
            'ajaxType' => 'GET',
            'ajaxUpdate' => array ($this->id),
            'pageVar' => $this->pagerVar(),
            'ajaxVar' => $this->ajaxVar,
            'pagerClass' => 'pagination',
            'loadingClass' => 'grid-view-loading',
            'filterClass' => 'filters',
            'tableClass' => 'items table table-hover',
            'selectableRows' => 1,
            'enableHistory' => false,
            'updateSelector' => '{page}, {sort}',
            'filterSelector' => '{filter}',
        );
        $options = MJavaScript::encode($options);
        app()->controller->appendScript(__CLASS__ . '#' . $this->getId(),
            "jQuery('#{$this->id}').yiiGridView($options);");

    }

    private function header() {

        $attrs = $this->model->attributeNames();

        $trStr = "";
        if ($this->columns) {
            foreach ($this->columns as $key => $one) {
                $attrsKey = isset($attrs[$key]) ? $attrs[$key] :
                    (($keys = $this->model->trans(array ($key))) ? $keys[$key] : $key);
                $trStr .= "<th class='header-{$key}'>{$attrsKey}</th>";
            }
        } else {
            foreach ($attrs as $key => $one) {
                $trStr .= "<th class='header-{$key}'>$one</th>";
            }
        }

        $buttonsStr = '';
        if ($this->buttons) {
            $buttonsStr = "<th class='header-buttons'></th>";
        }

        return <<<eot
            <thead>
                <tr>
                    $trStr
                    $buttonsStr
                </tr>
            </thead>
eot;
    }

    private function body() {

        $data = $this->model->getData();

        $strTr = "";
        if ($data) {

            if ($this->columns) {
                foreach ($data as $v) {
                    $tmp = '';
                    foreach ($this->columns as $k1 => $v1) {
                        $value = isset($v1['type']) ?
                            app()->formatter->format($v1['type'], $v[$k1],
                                isset($v1['htmlOptions']) ? $v1['htmlOptions'] : array ()) :
                            $v[$k1];

                        $tmp .= "<td><span class='{data-$k1}'>$value</span></td>";
                        $buttonsStr = '';
                    }
                    if ($this->buttons) {
                        $buttonsStr = $this->buttons->render($v);
                    }
                    $strTr .= "<tr>" . $tmp . $buttonsStr . "</tr>";
                }
            } else {
                foreach ($data as $v) {
                    $tmp = '';
                    foreach ($v as $k1 => $v1) {
                        $value = isset($v1['type']) ?
                            app()->formatter->format($v1['type'], $v1,
                                isset($v1['htmlOptions']) ? $v1['htmlOptions'] : array ()) :
                            $v1;

                        $tmp .= "<td><span class='{data-$k1}'>$value</span></td>";
                    }
                    $buttonsStr = '';
                    if ($this->buttons) {
                        $buttonsStr = $this->buttons->render($v);
                    }
                    $strTr .= "<tr>" . $tmp . $buttonsStr . "</tr>";
                }
            }
        }

        return <<<eot
            <tbody>
                {$strTr}
            </tbody>
eot;
    }

    function render() {

        $header = $this->header();
        $body = $this->body();
        $pageBody = $this->pageBody();

        return <<<eot
        <div id='{$this->id}' class='grid-view'>
            <table class="table table-hover">
                {$header}
                {$body}
            </table>
        </div>
        {$pageBody}
eot;

    }

    private function pagerVar() {
        return 'pager-' . $this->id;
    }

    private function pageBody() {
        $pagination = $this->model->getPagination();
        $pagination->setItemCount($this->model->getTotalItemCount());
        $pager = MPager::getInstance(array (
            'pagination' => $pagination,
            'pageVar' => $this->pagerVar(),
        ));

        return $pager->render();
    }
} 
