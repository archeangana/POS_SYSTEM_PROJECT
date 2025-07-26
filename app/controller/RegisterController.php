<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\User;
use Request;

class RegisterController extends Controller {

      public function indexAction() {
            // This method can be used to handle the default action for the RegisterController
            $this->view('auth/register');
      }

      public function registerAction($data) {
            // Logic for handling user registration
            // For example, validate input, save user to database, etc.
            $errorMessage = [];
            $successMessage = '';
       
  
                  if(
                        empty($data['username']) || 
                        empty($data['email']) || 
                        empty($data['password']) || 
                        empty($data['confirm_password'])) 
                  {
                        $errorMessage[] = "All fields are required.";
                  } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $errorMessage[] = "Invalid email format.";
                  } elseif($data['password'] !== $data['confirm_password']) {
                         $errorMessage[] = "Passwords do not match.";
                  } elseif(strlen($data['password']) < 6) {
                        $errorMessage[] = "Password must be at least 6 characters long.";
                  } else {
                        try {
                              $userModel = new User();
                              $existingUser = $userModel->getUserByEmail($data['email']);
                              if ($existingUser) {
                                    $errorMessage[] = "Email already exists.";
                              }
                              if($userModel->createUser($data) !== false) {
                                    $userModel->createUser($data);
                                    $successMessage = "Registration successful. You can now log in.";
                                    $this->view('auth/login', ['success' => $successMessage]);
                                    exit();
                              }
                        } catch (\Exception $e) {
                              $errorMessage[] = "Database error: " . $e->getMessage();
                        }
                  }
           
      }
}
