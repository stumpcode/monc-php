<?php


class MRouter extends MComponent {

    CONST ACTION_DEFAULT = 'index';
    CONST CONTROLLER_DEFAULT = 'default';

    /**
     * @var MRequest
     */
    private $request;

    function __construct($request) {
        $this->request = $request;
    }

    /**
     * @return MAction
     */
    public function createAction() {

        $uriWithOutParams = $this->request->uriWithOutParams;

        // ----------  /controller/action  ----------
        $mName = $cName = $aName = null;
        $cName = self::CONTROLLER_DEFAULT;
        $aName = self::ACTION_DEFAULT;

        if ($uriWithOutParams != '/') {

            $arr = explode('/', substr($uriWithOutParams, 1));

            $doneOffset = 0;
            if (count($arr) > 2) {
                list($mName, $cName, $aName) = $arr;
                $doneOffset = 3;

            } elseif (count($arr) > 1) {
                list($cName, $aName) = $arr;
                $doneOffset = 1;
                !$aName && $aName = self::ACTION_DEFAULT;
            } elseif (count($arr) > 0) {
                $cName = $arr[0];
                $aName = self::ACTION_DEFAULT;
            }

            // only when the slices more than 3, we can get param from uri
            if (count($arr) > 3) {
                $brr = array_slice($arr, $doneOffset);
                for ($i = 0; $i < count($brr); $i += 2) {
                    $_GET[$brr[$i]] = isset($brr[$i + 1]) ? $brr[$i + 1] : null;
                }
            }
        }

        $module = $mName ? new MModule($mName) : null;

        $cNameController = ucfirst($cName) . "Controller";
        if ($module) {
            Monc::import('monc.controller.' . $mName . '.*');
        }
        $controller = new $cNameController(strtolower($cName));
        $controller->setModule($module);

        $action = new MAction($controller, $aName);

        $controller->setAction($action);

        return $action;
    }
}
