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

      public function showAction() {
            $admins = (new Admin())->getAllAdmins();
            if(empty($admins)) {
                  $admins = [];
            }
            $this->view('admin/admins/index', ['admins' => $admins]);
      }

      public function addAction($data) {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                  $errorMessage = [];

                  // Sanitize Input
                  $name = htmlspecialchars(trim($data['name'] ?? ''), ENT_QUOTES, 'UTF-8');
                  $password = trim($data['password'] ?? '');
                  $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
                  $phone = trim($data['phone'] ?? '');
                  $is_ban = isset($data['is_ban']) ? 1 : 0;

                  // Validate Input
                  if(empty($name) &&  empty($password) && empty($email) && empty($phone)) {
                        $errorMessage[] = 'All fields are required.';
                  } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

      public function createAction() {
            $this->view('admin/admins/index');
      }

      public function editAction($data) {
            $id = $data['id'] ?? '';
            if(isset($id)) {
                if(!empty($id)) {
                        $admin = new Admin();
                        $adminData = $admin->getadminById($id);
                        $this->view('admin/admins/index', ['data' => $adminData]);
                }  
            }
      }

      public function updateAction($data) {

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['submit'])) {
                  $errorMessage = [];
                  // Sanitize Input
                  $name = htmlspecialchars(trim($data['name'] ?? ''), ENT_QUOTES, 'UTF-8');
                  $password = trim($data['password'] ?? '');
                  $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
                  $phone = trim($data['phone'] ?? '');
                  $is_ban = isset($data['is_ban']) ? 1 : 0;

                  // Validate Input
                  if(empty($name) &&  empty($password) && empty($email) && empty($phone)) {
                        $errorMessage[] = 'All fields are required.';
                  } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                              $newAdminData = [
                                    'id' => $data['id'],
                                    'name' => $name,
                                    'password' => $password,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'is_ban' => $is_ban
                              ];
                              $adminModel->updateAdmin($newAdminData);
                              Flash::set('success', 'Admin Successfully Updated!');
                              $this->redirectToPage('admin/admins', 'admin');
                              exit();
                        } catch(\Exception $e) {
                              error_log("Registration error: " . $e->getMessage());
                              $errorMessage[] = "An unexpected error occurred. Please try again later.";
                        }
                  }
            } else {
                  Flash::set('error', "Failed to update admin info.");
                  $this->redirectToPage('admin', 'edit');
            }
      }

      public function deleteAction($data) {
            $id = $data['id'] ?? '';
            if(isset($id)) {
                  if(!empty($id)) {
                        $adminModel = new Admin();
                        $adminModel->deleteAdmin($id);
                        Flash::set('success', 'Admin Successfully Deleted');
                        $this->redirectToPage('admin', 'show');
                        exit();
                  }
            } else {
                  return false;
            }
      }

}