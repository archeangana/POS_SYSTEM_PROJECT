<?php

$routes = [
      'login' => [
            'controller' => 'AuthController',
            'file' => 'controller/AuthController.php',
            'action' => 'login'
      ],
      'home' => [
            'controller' => 'HomeController',
            'file' => 'controller/HomeController.php',
            'action' => 'index'
      ],
      'error' => [
            'controller' => 'ErrorController',
            'file' => 'controller/ErrorController.php',
            'action' => 'notFound'
      ],
];