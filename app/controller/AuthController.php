<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\User;

class AuthController extends Controller {

      public function indexAction() {
            // This method can be used to handle the default action for the AuthController
            $this->view('auth/login');
      }

      public function loginAction() {

            $_SESSION['is_logged_in'] = true;
            
            $this->view('home/index');
            exit();
      }

      public function logoutAction() {
            session_start();
            session_unset();
            session_destroy();
            header("Location: ../app/views/auth/login.php");
            exit();
      }

}
