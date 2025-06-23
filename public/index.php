<?php

require_once "./controller/Controller.php";

$page = $_GET['page'] ?? $_POST['page'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'index';     

switch($page) {
      case 'about':
            include "./controller/AboutUsController.php";
            $aboutusController = new AboutUsController();
            $aboutusController->runAction($action);
            break;
      case 'contact':
            include "./controller/ContactController.php";
            $contactController = new ContactController();
            $contactController->runAction($action);
            break;
      case 'services':
            include "./controller/ServicesController.php";
            $serviceController = new ServicesController();
            $serviceController->runAction($action);
            break;
      default:
            include "./controller/HomePageController.php";
}

