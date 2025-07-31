<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\Helpers\BaseUrl;
use App\Model\Admin;
use App\Core\Helpers\Flash;

class AdminController extends Controller {

      public function indexAction() {
            $this->view('admin/index');
      }

      public function adminAction() {
            $admins = (new Admin())->getAllAdmins();
            if(empty($admins)) {
                  $admins = [];
            }
            $this->view('admin/index', ['admins' => $admins]);
      }

      public function addAdminAction($data) {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

                  $errorMessage = [];

                  // Sanitize Input
                  $name = htmlspecialchars(trim($data['name'] ?? ''));
                  $password = trim($data['password'] ?? '');
                  $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
                  $phone = trim($data['phone'] ?? '');
                  $is_ban = $data['is_ban'] ? 1 : 0;

                  // Validate Input
                  if(empty($name) &&  empty($password) && empty($email) && empty($phone)) {
                        $errorMessage[] = 'All fiels are required.';
                  } elseif(!filter_var($email, FILTER_SANITIZE_EMAIL)) {
                        $errorMessage[] = 'Invalid Email Format.';
                  } elseif(empty($password)) {
                        $errorMessage[] = 'Password is Required.';
                  } elseif(strlen($password) < 6) {
                        $errorMessage[] = 'Password must be atleast 6 characters.';
                  } elseif(empty($phone)) {
                        $errorMessage[] = 'Phone is Required.';
                  }

                  if(empty($errorMessage)) {
                        try {
                              $adminModel = new Admin();
                              if($adminModel->getAdminByEmail($email)) {
                                    $errorMessage[] = 'Email is already exist.';
                              } else {
                                    $newAdminData = [
                                          'name' => $name,
                                          'password' => $password,
                                          'email' => $email,
                                          'phone' => $phone,
                                          'is_ban' => $is_ban
                                    ];

                                    $adminModel->addAdmin($newAdminData);
                                    Flash::set('success', 'Admin Successfully created!');
                                    $this->redirectToPage('admin', 'admin');
                                    exit();
                              }
                        } catch(\Exception $e) {
                              error_log("Registration error: " . $e->getMessage());
                              $errorMessage[] = "An unexpected error occurred. Please try again later.";
                        }
                  }
            }
      }

      public function createAdminAction() {
            $this->view('admin/index');
      }

      public function updateAction() {

      }

      public function deleteAction($id) {
            
      }

}