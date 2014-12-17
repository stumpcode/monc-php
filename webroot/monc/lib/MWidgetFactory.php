<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/21
 * Time: 上午8:31
 */
class MWidgetFactory extends MComponent {

    public $widgets=array();

    function createWidget($owner, $className, $properties = array ()) {

        $className = Monc::importlib($className, true);
        $widget = new $className($owner);

        if (isset($this->widgets[$className])) {

            $properties = $properties === array () ? $this->widgets[$className] :
                MMap::mergeArray($this->widgets[$className], $properties);
        }

        foreach ($properties as $name => $value)
            $widget->$name = $value;
        return $widget;
    }

    function init() {

    }

} 
