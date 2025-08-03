<?php 

namespace App\Controller;
use App\Core\Controller;
use App\Model\Category;
use App\Model\Product;

class ProductController extends Controller {
      
      public function indexAction() {

            $this->view('admin/products/index');
      }

      public function showAction() {
            $this->view('admin/products/index');
      }

      public function createAction() {
            $categoryData = (new Category())->getAll();
            if(empty($categoryData)) {
                  $categoryData = [];
            }
            $this->view('admin/products/index', ['data' => $categoryData]);
      }

      public function addAction($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                  $errorMessage = [];

                  // Sanitize inputs
                  $category_id = trim($data['category_id'] ?? '');
                  $name = htmlspecialchars(trim($data['name'] ?? ''), ENT_QUOTES, 'UTF-8');
                  $description = htmlspecialchars(trim($data['description'] ?? ''));
                  $price = trim($data['price'] ?? 0);
                  $quantity = trim($data['quantity'] ?? 1); // Fixed bug here
                  $status = isset($data['status']) && $data['status'] === 'active' ? 1 : 0;
                  $imagePath = null;

                  // File validation block
                  if (!empty($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                        $maxFileSize = 2 * 1024 * 1024; // 2MB

                        $file = $_FILES['image'];

                        if ($file['error'] !== UPLOAD_ERR_OK) {
                              $errorMessage[] = 'File upload error.';
                        } else {
                              $fileTmpPath = $file['tmp_name'];
                              $fileSize = $file['size'];
                              $fileName = basename($file['name']);
                              $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                              $fileMimeType = mime_content_type($fileTmpPath);

                        if (!in_array($fileMimeType, $allowedMimeTypes)) {
                              $errorMessage[] = 'Invalid file type.';
                        }

                        if (!in_array($fileExtension, $allowedExtensions)) {
                              $errorMessage[] = 'File extension not allowed.';
                        }

                        if ($fileSize > $maxFileSize) {
                              $errorMessage[] = 'File size exceeds 2MB.';
                        }

                              $safeFileName = uniqid('img_', true) . '.' . $fileExtension;
                              $uploadDir = '/assets/uploads/products';

                        if (!is_dir($uploadDir)) {
                              mkdir($uploadDir, 0755, true);
                        }

                              $destination = $uploadDir . $safeFileName;

                        if (empty($errorMessage)) {
                              if (!move_uploaded_file($fileTmpPath, $destination)) {
                                    $errorMessage[] = 'Could not save the uploaded image.';
                              } else {
                                    $imagePath = 'uploads/' . $safeFileName;
                              }
                        }
                        }
                  }

                  // Proceed with saving to DB
                  if (empty($errorMessage)) {
                        $productModel = new Product(); 
                        $productModel->create([
                              'category_id' => $category_id,
                              'name' => $name,
                              'description' => $description,
                              'price' => $price,
                              'quantity' => $quantity,
                              'status' => $status,
                              'image' => $imagePath,
                        ]);

                        Flash::set('success', 'Product added successfully!');
                        $this->redirectToPage('product', 'show');
                        exit();
                  } else {
                        Flash::set('error', implode('<br>', $errorMessage));
                        $this->redirectToPage('product', 'create');
                        exit();
                  }
            }
      }

      public function editAction() {

      }

}
