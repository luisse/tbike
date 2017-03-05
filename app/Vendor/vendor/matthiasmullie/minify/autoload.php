<?php

spl_autoload_register(function ($class) {
    // the package namespace
    $ns = 'Minify';

    $base_dir = __DIR__ . '/src';

    $prefix_len = strlen($ns);
    if (substr($class, 0, $prefix_len) !== $ns) {
        return;
    }


    // strip the prefix off the class
    $class = substr($class, $prefix_len);

    // a partial filename
    $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
	$this->log('Class: '.$file, LOG_DEBUG);
require $file;
    if (is_readable($file)) {
	$this->log($file, LOG_DEBUG);
        require $file;
    }

});
