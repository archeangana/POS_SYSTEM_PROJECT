<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\User;

class RegisterController extends Controller {

      public function indexAction() {
            // This method can be used to handle the default action for the RegisterController
            $title = 'Register';
            $data = ['title' => $title];
            $this->view('auth/register', $data);
      }

      public function registerAction($data) {
            if($_SERVER['REQUEST_METHOD'] !== 'POST') {
                  // If not a POST request, redirect to the registration page
                  $this->redirect('auth/register');
                  exit();
            }
         
            $errorMessage = [];
            $successMessage = '';

            // Sanitize and trim input
            $username = htmlspecialchars(trim($data['username'] ?? ''));
            $email = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = trim($data['password'] ?? '');
            $confirm_password = trim($data['confirm_password'] ?? '');
            $csrf_token = trim($data['csrf_token'] ?? '');

            if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $csrf_token) {
                  $errorMessage[] = "Invalid CSRF token.";
            }

            // Validation checks
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                  $errorMessage[] = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $errorMessage[] = "Invalid email format.";
            } elseif ($password !== $confirm_password) {
                  $errorMessage[] = "Passwords do not match.";
            } elseif (strlen($password) < 6) {
                  $errorMessage[] = "Password must be at least 6 characters long.";
            }

            if (empty($errorMessage)) {
            
                  try {
                        $userModel = new User();
                           
                        // Check for existing user
                        if ($userModel->getUserByEmail($email)) {
                              $errorMessage[] = "Email already exists.";
                                 
                        } else {
                              // Create user
                              $newUserData = [
                                    'username' => $username,
                                    'email' => $email,
                                    'password' => $password,
                                    'confirm_password' => $confirm_password,
                                    'csrf_token' => $csrf_token
                              ];
                              if ($userModel) {
                                    $userModel->createUser($newUserData);
                                    $successMessage = "Registration successful. You can now log in.";
                                    $this->view('auth/login', ['success' => $successMessage]);
                                    exit();
                              } else {
                                    $errorMessage[] = "Registration failed. Please try again.";
                              }
                        }
                  } catch (\Exception $e) {
                        // Log error internally, but do not expose details to the user
                        error_log("Registration error: " . $e->getMessage());
                        $errorMessage[] = "An unexpected error occurred. Please try again later.";
                  }
            }

            // Render view with error
            $this->view('auth/register', ['errors' => $errorMessage]);
      }
}
