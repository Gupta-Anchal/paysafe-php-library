<?php

function __PaysafeNetellerAutoloader($className)
{
    $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    if (($classFile = realpath(__DIR__ . DIRECTORY_SEPARATOR . $classPath . '.php'))) {
        require_once( $classFile );
    }
}

spl_autoload_register('__PaysafeNetellerAutoloader');
