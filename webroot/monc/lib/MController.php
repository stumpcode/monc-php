<?php


class MController extends MComponent {

    public $id;
    /**
     * @var MRequest
     */
    private $request;

    /**
     * @var MModule
     */
    public $module;
    private $action;
    public $pageTitle = 'monc';

    public $layout = 'layout/main';
    public $user;

    public function get($key, $default = null) {
        return $this->request->get($key, $default);
    }

    public function post($key, $default = null) {
        return $this->request->post($key, $default);
    }

    function __construct($id) {
        $this->id = $id;
        $this->user = Monc::app()->user;
        $this->request = Monc::app()->request;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action) {
        $this->action = $action;
    }

    /**
     * @return MRequest
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request) {
        $this->request = $request;
    }

    public function render($view, $params = array ()) {

        extract($params);


        if (false !== ($pos = strpos($view, '/')) && $pos == 0) {

            require(MONC . 'view' . $view . '.php');

        } else {

            $action = $this->action;
            !$view && $view = $action->id;

            $mpath = $this->module ? DS . $this->module->id : '';

            require(MONC . 'view' . $mpath . DS . $this->id . DS
                . $view . '.php');

        }


        $content = ob_get_contents();
        ob_clean();
        require(MONC . 'view' . DS . $this->layout . '.php');

        Monc::end();
    }

    function renderCode($code = 0, $msg = '', $arr = array ()) {
        header('Content-type: application/json');
        echo json_encode(array_merge(array (
            'code' => $code,
            'msg' => $msg,
        ), $arr));
        Monc::end();
    }

    private $_wrap = array ();

    function wrap($path) {
        array_push($this->_wrap, $path);
        ob_clean();
    }

    function endWrap() {

        $content = ob_get_contents();
        ob_clean();

        $path = array_pop($this->_wrap);

        require(MONC . 'view' . DS . $path . '.php');
    }


    public function renderPartial($view, $params = array ()) {

        extract($params);

        if (false !== ($pos = strpos($view, '/')) && $pos == 0) {
            require(MONC . 'view' . DS . $view . '.php');
        } else {

            $mpath = $this->module ? DS . $this->module->id : '';

            require(MONC . 'view' . $mpath . DS . $this->id . DS
                . $view . '.php');
        }

    }

    public function url($link, $param = array ()) {

        if (substr($link, 0, 1) != '/') {
            $prefix = '';
            $this->module && $prefix .= '/' . $this->module->id;
            $prefix .= '/' . $this->id;
            $link = $prefix . '/' . $link;
        }

        preg_match('/\//', $link, $matches);
        if (count($matches) > 2) {
            foreach ($param as $k => $v) {
                $link .= "/$k/" . urlencode($v);
            }
        } else {
            if (false === strpos($link, '?')) {
                $link .= '?';
            }

            if ($param) {
                foreach ($param as $k => $v) {
                    $link .= "$k=" . urlencode($v) . "&";
                }
                $link = substr($link, 0, -1);
            }
        }

        return $link;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module) {
        $this->module = $module;
    }

    function beforeAction($action) {

    }

    function afterAction($action) {

    }

    function redirect($url, $statusCode = 302) {
        header('Location: ' . $url, true, $statusCode);
        Monc::end();
    }

    // ----------  widgets  ----------

    public function createWidget($className, $properties = array ()) {
        $widget = Monc::app()->getWidgetFactory()->createWidget($this, $className, $properties);
        $widget->init();
        return $widget;
    }

    public function beginWidget($className, $properties = array ()) {
        $widget = $this->createWidget($className, $properties);
        $this->_widgetStack[] = $widget;
        return $widget;
    }

    public function endWidget($id = '') {
        if (($widget = array_pop($this->_widgetStack)) !== null) {
            $widget->run();
            return $widget;
        } else
            throw new CException(Yii::t('yii',
                '{controller} has an extra endWidget({id}) call in its view.',
                array ('{controller}' => get_class($this), '{id}' => $id)));
    }

    function isPost() {
        return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
    }


    private $scriptArr = array ();

    /**
     * @return array
     */
    public function getScript() {
        return $this->scriptArr;
    }

    function appendScript($key, $script) {
        if (isset($this->scriptArr[$key])) {
            return;
        }
        $this->scriptArr[$key] = $script;
    }

}
