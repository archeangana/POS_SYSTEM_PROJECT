<?php
namespace App\Controller;
use App\Core\Controller;

class ErrorController extends Controller {
      public function notFound() {
            // This method can be used to handle 404 errors
            $this->view('error/404');
      }
      
      public function serverError() {
            // This method can be used to handle 500 errors
            $this->view('error/500');
      }
}