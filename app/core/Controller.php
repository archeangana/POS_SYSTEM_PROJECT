<?php

namespace App\Core;

class Controller {

      protected $viewPath = '../app/views/';
      
      public function view($view, $data = []) {
            $filePath = $this->viewPath . $view . '.php';
            if (file_exists($filePath)) {
                  extract($data);
                  include_once $filePath;
            } else {
                  echo "View not found: " . htmlspecialchars($view);
            }
      }
      
      public function redirect($url) {
            header("Location: " . $viewPath .$url . '.php');
            exit();
      }

}