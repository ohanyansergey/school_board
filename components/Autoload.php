<?php

spl_autoload_register(function ($class_name) {
    $paths = [
        '/components/',
        '/controllers/',
        '/models/',
    ];

    foreach($paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if(is_file($path)) include_once $path;
    }
});
