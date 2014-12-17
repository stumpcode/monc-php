<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/22
 * Time: 上午10:24
 */
class MFormModel extends MModel {

    private static $_names = array ();

    public function attributeNames() {
        $className = get_class($this);
        if (!isset(self::$_names[$className])) {
            $class = new ReflectionClass(get_class($this));
            $names = array ();
            foreach ($class->getProperties() as $property) {
                $name = $property->getName();
                if ($property->isPublic() && !$property->isStatic())
                    $names[] = $name;
            }
            return self::$_names[$className] = $names;
        } else
            return self::$_names[$className];
    }
}
