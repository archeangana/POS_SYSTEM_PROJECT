<?php

namespace App\Controller;
use App\Core\Controller;

class AuthController extends Controller {

      public function indexAction() {
            // This method can be used to handle the default action for the AuthController
            $this->view('auth/login');
      }

      public function loginAction() {
            $this->view('home/index');
      }
}
