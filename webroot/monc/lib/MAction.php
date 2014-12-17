<?php


class MAction extends MComponent {

    public $id;
    public $controller;

    function __construct($controller, $id) {
        $this->controller = $controller;
        $this->id = $id;
    }

    public function run() {

        $actionName = $this->id;
        $this->controller->beforeAction($this);
        $this->controller->$actionName();
        $this->controller->afterAction($this);
    }
}
