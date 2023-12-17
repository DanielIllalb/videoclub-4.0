<?php
function myAutoloader($className)
{
    $classFile = __DIR__ . '/' . $className . '.php';
    if (file_exists($classFile)) {
        include $classFile;
    }
}

spl_autoload_register('myAutoloader');
?>