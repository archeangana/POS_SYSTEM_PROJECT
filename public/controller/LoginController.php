<?php

class LoginController extends Controller {

      public function indexAction() {
            include './views/auth/login.php';
      }

      public function loginAction() {
            // Handle login logic here
            // For example, validate user credentials and redirect to dashboard
            include './views/dashboard/dashboard.php';
      }

  

//     public function loginAction() {
//         // Handle login logic here
//         // For example, validate user credentials and redirect to dashboard
//         include './views/dashboard/dashboard.php';
//     }

//     public function logoutAction() {
//         // Handle logout logic here
//         session_start();
//         session_destroy();
//         header("Location: /CMS_PROJECT/public/index.php");
//     }
}