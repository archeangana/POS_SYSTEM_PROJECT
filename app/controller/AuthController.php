<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\User;
use App\Core\Helpers\Flash;

class AuthController extends Controller {
     

      public function indexAction() {
            // This method can be used to handle the default action for the AuthController
            $title = 'Login';
            $data = ['title' => $title];
            $this->view('auth/login', $data);
      }

      public function loginAction() {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                  // If not a POST request, redirect to the login page
                  $this->redirect('auth/login');
                  exit();
            }


            $errorMessage = [];
            // Sanitize and trim input
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            // Validation checks
            if (empty($email) || empty($password)) {
                  $errorMessage[] = "Email and password are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $errorMessage[] = "Invalid email format.";
            }
            if (empty($errorMessage)) {
                  try {
                        $userModel = new User();
                        $user = $userModel->loginUser(['email' => $email, 'password' => $password]);

                        if ($user) {
                              // Redirect to home page after successful login
                              $_SESSION['logged_in_user'] = $user;
                              $_SESSION['is_logged_in'] = true;
                           
                              $this->redirectToPage('admin');
                              exit();
                        } else {
                              $errorMessage[] = "Invalid email or password.";
                        }
                  } catch (\Exception $e) {
                        $errorMessage[] = "An error occurred while logging in: " . $e->getMessage();
                  }
            }
            foreach($errorMessage as $error) {
                  Flash::set('error', $error);
            }
            $title = 'Login';
            $this->view('auth/login', ['title' => $title]);
            exit();
      }

      public function logoutAction() {
            session_unset();
            session_destroy();
            $this->indexAction();
            exit();
      }

}
