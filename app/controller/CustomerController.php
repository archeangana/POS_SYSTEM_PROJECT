<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Customer;
use App\Core\Helpers\Flash;
use App\Core\Helpers\ResponseJSON;

class CustomerController extends Controller {

      public function indexAction() {
            $this->view('admin/customer/index');
      }

      public function showAction() {
            $customerData = (new Customer())->getAll();
            if(empty($customerData)) {
                  $customerData = [];
            }
            $this->view('admin/customer/index' , ['data' => $customerData]);
      }

      public function createAction() {
            $this->view('admin/customer/index');
      }

      public function addAction($data) {
            ob_start();
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                  $errorMessage = [];
                  // Sanitize inputs
                  $name = htmlspecialchars(trim($data['name'] ?? ''), ENT_QUOTES, 'UTF-8');
                  $email = filter_var(trim($data['email'], FILTER_SANITIZE_EMAIL));
                  $phone = trim($data['phone'] ?? 0);
                  $status = isset($data['status']) && $data['status'] === 'active' ? 1 : 0;
              
                  // Validate inputs
                  if(empty($name)) {
                        $errorMessage[] = 'Name is required.';
                  } 

                  // Email duplication check
                  if (!empty($email)) {
                        $customer = (new Customer())->getCustomerByEmail($email);
                        if (!empty($customer)) {
                              $errorMessage[] = 'Email already exists.';
                        }
                  }

                  if(empty($errorMessage)) {
                        $sanitizedData = [
                              'name' => $name,
                              'email' => $email,
                              'phone' => $phone,
                              'status' => $status
                        ];
                        $customerModel = new Customer();
                        $customerModel->create($sanitizedData);
                        Flash::set('success', 'Customer added successfully.');
                        $this->redirectToPage('customer', 'show');

                  } else {
                        Flash::set('error', implode('<br>', $errorMessage));
                        $this->redirectToPage('customer', 'create');
                  }
            }

            if (!empty($data['submitted']) && filter_var($data['submitted'], FILTER_VALIDATE_BOOLEAN)) {
                  // Sanitize input
                  $name   = htmlspecialchars(trim($data['name']));
                  $email  = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
                  $phone  = trim($data['phone']);
                  $status = isset($data['status']) && $data['status'] === 'active' ? 1 : 0;

                  // Validate: email required & correct format
                  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        ResponseJSON::jsonResponse(400, 'error', 'Invalid or missing email');
                  }

                  // Check if email exists
                  $customerModel = new Customer();
                  if ($customerModel->getCustomerByEmail($email)) {
                        ResponseJSON::jsonResponse(401, 'error', 'Email already exists');
                  }

                  // Prepare data array for customer creation
                  $newCustomerData = [
                        'name'   => $name,
                        'email'  => $email,
                        'phone'  => $phone,
                        'status' => $status
                  ];

                  // Create customer
                  if ($customerModel->create($newCustomerData)) {
                        ResponseJSON::jsonResponse(200, 'success', 'Customer created successfully');
                  } else {
                        ResponseJSON::jsonResponse(500, 'error', 'Failed to create customer');
                  }
            }
      }

      public function updateAction($data) {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

                  $errorMessage = [];
                  // Sanitize inputs
                  $name = htmlspecialchars(trim($data['name'] ?? ''), ENT_QUOTES, 'UTF-8');
                  $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
                  $phone = trim($data['phone'] ?? 0);
                  $status = isset($data['status']) && $data['status'] === 'active' ? 1 : 0;
                  $id = $data['id'] ?? null;
              
                  // Validate inputs
                  if(empty($name)) {
                        $errorMessage[] = 'Name is required.';
                  }
                  
                  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorMessage[] = 'email must contain @ symbol';
                  }

                  // Email duplication check (exclude current record)
                  if (!empty($email)) {
                        $customer = (new Customer())->getCustomerByEmail($email);
                        if (!empty($customer) && $customer['id'] != $id) {
                              $errorMessage[] = 'Email already exists.';
                        }
                  }

                  if(empty($errorMessage)) {
                        $sanitizedData = [
                              'id' => $id,
                              'name' => $name,
                              'email' => $email,
                              'phone' => $phone,
                              'status' => $status
                        ];

                        $customerModel = new Customer();
                        $customerModel->update($sanitizedData);
                        Flash::set('success', 'Customer Updated successfully.');
                        $this->redirectToPage('customer', 'show');

                  } else {
                        Flash::set('error', implode('<br>', $errorMessage));
                        $this->redirectToPage('customer', 'edit&id=' . $id);
                  }
            }
      }

      public function editAction($data) {
            $id = $data['id'] ?? null;
            if(!empty($id) && isset($id)) {
                  $customerModel = new Customer();
                  $data = $customerModel->getCustomerById($id);
                  $this->view('admin/customer/index', ['data' => $data]);
                  exit();
            }
            $this->redirectToPage('customer', 'show');
      }

      public function deleteAction($data) {
            $id = $_GET['id'] ?? null;
            if(!empty($id) && isset($id)) {
                  $customerModel = new Customer();
                  $customerData = $customerModel->delete($id);
                  if($customerData) {
                        Flash::set('success', 'Customer Deleted successfully.');
                        $this->redirectToPage('customer', 'show');
                  } else {
                        Flash::set('error', 'You cannot delete this customer as they have associated orders.');
                        $this->redirectToPage('customer', 'show');
                  }
            }
      }

}