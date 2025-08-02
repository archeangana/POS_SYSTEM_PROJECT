<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Category;
use App\Core\Helpers\Flash;

class CategoryController extends Controller {

      public function indexAction() {

            $this->view('admin/category/index');
      }
      
      public function showAction() {

            $categoryModel = new Category();
            $data = $categoryModel->getAll();
            if($data) {
                  $this->view('admin/category/index', ['data' => $data]);
            }
      }
      
      public function createAction() {
            $this->view('admin/category/index');
      }

      public function addAction($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['submit'])) {
                  $errorMessage = [];

                  // Sanitize inputs
                  $name = htmlspecialchars(trim($data['name'] ?? ''));
                  $description = htmlspecialchars(trim($data['description'] ?? ''));
                  $status = trim($data['status']) === 'active' ? 1 : 0;

                  // Validate
                  if ($name === '') {
                        $errorMessage[] = 'Name is required.';
                  }

                  if ($description === '') {
                        $errorMessage[] = 'Description is required.';
                  }

                  if (!isset($data['status'])) {
                        $errorMessage[] = 'Must set the status.';
                  }

                  if (empty($errorMessage)) {
                        try {
                              $categoryModel = new Category();
                              $categoryData = [
                                    'name' => $name,
                                    'description' => $description,
                                    'status' => $status
                              ];

                              $categoryModel->createCategory($categoryData);
                              Flash::set('success', 'Category created successfully!');
                              $this->redirectToPage('category', 'show');
                              exit();
                        } catch (\Exception $e) {
                              error_log("Category creation error: " . $e->getMessage());
                              $errorMessage[] = "An unexpected error occurred. Please try again later.";
                        }
                  }

                  Flash::set('error', implode('<br>', $errorMessage));
                  $this->redirectToPage('category', 'create');
                  exit();
            }

            Flash::set('error', 'Failed to create category.');
            $this->redirectToPage('category', 'create');
            exit();
      }

      public function editAction($data) {
            $id = $data['id'] ?? '';
            if(isset($id)) {
                  $categoryModel = new Category();
                  $categoryData = $categoryModel->getCategoryById($id);
                  $this->view('admin/category/index', ['data' => $categoryData]);
                  exit();
            }
      }

      public function updateAction($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['submit'])) {
                  $errorMessage = [];

                  // Sanitize inputs
                  $name = htmlspecialchars(trim($data['name'] ?? ''));
                  $description = htmlspecialchars(trim($data['description'] ?? ''));
                  $status = trim($data['status']) == 'active' ? 1 : 0;

                  // Validate
                  if ($name === '') {
                        $errorMessage[] = 'Name is required.';
                  }

                  if ($description === '') {
                        $errorMessage[] = 'Description is required.';
                  }

                  if (!isset($data['status'])) {
                        $errorMessage[] = 'Must set the status.';
                  }

                  if (empty($errorMessage)) {
                        try {
                              $categoryModel = new Category();
                              $newCategoryData = [
                                    'id' => $data['id'],
                                    'name' => $name,
                                    'description' => $description,
                                    'status' => $status
                              ];

                              $categoryModel->updateCategory($newCategoryData);
                              Flash::set('success', 'Category Updated successfully!');
                              $this->redirectToPage('category', 'show');
                              exit();
                        } catch (\Exception $e) {
                              error_log("Category creation error: " . $e->getMessage());
                              $errorMessage[] = "An unexpected error occurred. Please try again later.";
                        }
                  }

                  Flash::set('error', implode('<br>', $errorMessage));
                  $this->redirectToPage('category', 'edit');
                  exit();
            }

            Flash::set('error', 'Failed to Update category.');
            $this->redirectToPage('category', 'edit');
            exit();
      }

      public function deleteAction($data) {
            $id = $data['id'] ?? '';
            if(isset($id)) {
                  $categoryModel = new Category();
                  $categoryModel->deleteCategory($id);
                  Flash::set('success', 'Deleted Successfully!');
                  $this->redirectToPage('category', 'show');
                  exit();
            } else {
                  Flash::set('error', 'Failed to Delete');
                  $this->redirectToPage('category', 'show');
                  exit();
            }
      }


}