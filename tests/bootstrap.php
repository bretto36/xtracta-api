<?php

include('vendor/autoload.php');

function class_auto_loader($className)
{
    $parts = explode('\\', $className);
    $path = 'src/' . implode('/', $parts) . '.php';

    require_once $path;
}

spl_autoload_register('class_auto_loader');