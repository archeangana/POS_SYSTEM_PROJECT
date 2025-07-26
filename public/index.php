<?php 

      require_once '../vendor/autoload.php';
      include '../routes/web.php';

      $page = $_GET['page'] ?? $_POST['page'] ?? 'home';
      $action = $_GET['action'] ?? $_POST['action'] ?? 'index';

      if (isset($routes[$page])) {
            $route = $routes[$page];
            include_once '../app/' . $route['file'];
            $controllerClass = 'App\\Controller\\' . $route['controller'];
            if (!class_exists($controllerClass)) {
                  echo "Controller not found.";
                  exit();
            }
            $controller = new $controllerClass();
            if (method_exists($controller, $route['actions'][$action] . 'Action')) {
                  $method = $route['actions'][$action] . 'Action';
                  $args = array_diff_key($_REQUEST, array_flip(['page', 'action']));
                  call_user_func_array([$controller, $method], [$args]);
            } else {
                  echo "Action not found.";
            }
      } else {
            include_once '../app/controller/ErrorController.php';
            $errorController = new \App\Controller\ErrorController();
            $errorController->notFound();
      }

      


