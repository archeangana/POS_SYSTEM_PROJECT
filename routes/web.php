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
      'admin' => [
            'controller' => 'AdminController',
            'file' => 'controller/AdminController.php',
            'actions' => [
                  'index' => 'index',
                  'createAdmin' => 'createAdmin',
                  'edit' => 'edit',
                  'update' => 'update',
                  'delete' => 'delete',
                  'admin' => 'admin',
                  'addAdmin' => 'addAdmin',
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