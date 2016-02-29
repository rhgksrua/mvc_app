<?php

/**
 *
 * bootstrap.php
 *
 * This runs before anything happens
 *
 */

// autoload classes

/**
 * An example of a project-specific implementation.
 * 
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
 * from /path/to/project/src/Baz/Qux.php:
 *
 *  new \Foo\Bar\Baz\Qux;
 *
 * spl_autoload_register function taken from
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 * 
 *      
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {

        // project-specific namespace prefix
    $prefix = 'Hankmvc';

    // base directory for the namespace prefix
    $base_dir = dirname(__DIR__);
    //echo $base_dir . "\n";

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);
    //echo $relative_class;

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    //echo $file;

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

//require "../Controller/Controller.php";
require "../helper/debug.php";
//require "../helper/App.php";
//require "../helper/Router.php";
require "../helper/config.php";
//require '../Model/Model.php';


