<?php

$routes = [
      'login' => [
            'controller' => 'AuthController',
            'file' => 'controller/AuthController.php',
            'actions' => [
                  'index' => 'index',
                  'login' => 'login',
                  'logout' => 'logout',
            ]
      ],
      'register' => [
            'controller' => 'RegisterController',
            'file' => 'controller/RegisterController.php',
            'actions' => [
                  'index' => 'index',
                  'register' => 'register',
            ]
      ],
      'home' => [
            'controller' => 'HomeController',
            'file' => 'controller/HomeController.php',
            'actions' => [
                  'index' => 'index',
            ]
      ],
      'error' => [
            'controller' => 'ErrorController',
            'file' => 'controller/ErrorController.php',
            'actions' => [
                  'notFound' => 'notFound',
            ]
      ],
];