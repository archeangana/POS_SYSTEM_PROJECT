<?php

namespace App\Core;

class Controller {

      protected $viewPath =  __DIR__ . '/../views/';
      
      public function view($view, $data = []) {
            $view = preg_replace('/\.\.\/?/', '', $view);
            $filePath = $this->viewPath . $view . '.php';
            if (file_exists($filePath)) {
                  extract($data);
                  include_once $filePath;
            } else {
                  echo "View not found: " . htmlspecialchars($view);
            }
      }

      protected function getBaseUrl() {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            $host = $_SERVER['HTTP_HOST']; // Get the Domain
            $scriptName = $_SERVER['SCRIPT_NAME']; // Get the current file

            // Remove index.php or similar from the script path
            $scriptDir = str_replace(basename($scriptName), '', $scriptName); // Removing the index.php file in the URI
            // Result
            // $scriptDir = '/myproject/public/';

            return "{$protocol}://{$host}{$scriptDir}"; // http://domain/myproject/public
      }
      
      public function redirect($path = '') {
            // Automatically use base URL
            $baseUrl = $this->getBaseUrl();
            
            // Redirect to full URL path
            header("Location: " . rtrim($baseUrl, '/') . '/' . ltrim($path, '/'));
            exit();
      }

      public function redirectToPage($page, $action = 'index')
      {
            $this->redirect("?page={$page}&action={$action}");
      }

}