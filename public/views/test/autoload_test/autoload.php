<?php

spl_autoload_register(function ($className) {
    $fileName = "classes/" . $className . '.php';
    if (file_exists($fileName)) {
        include_once $fileName;
        return true;
    }
    throw new Exception("Class file not found: " . $fileName);
});