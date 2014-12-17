<?php

spl_autoload_register(
    function ($class) {
        if (!isset(Monc::app()->import[$class . '.php'])) {
            throw new Exception('not found class [' . $class . ']');
        }
        include(Monc::app()->import[$class . '.php']);
    }
);
