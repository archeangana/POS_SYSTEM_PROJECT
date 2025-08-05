<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Order;
use App\Model\Product;
use App\Core\Helpers\Flash;

class OrderController extends Controller {

      public function indexAction() {
            $this->view('admin/orders/index');
      }

      public function createAction() {
            $productsData = (new Product())->getAll();
            if(empty($productsData)) {
                  $productsData = [];
            }
            $this->view('admin/orders/index', ['products' => $productsData]);
      }

      public function addAction($data) {
            if(!isset($_SESSION['productOrderIds'])) {
                  $_SESSION['productOrderIds'] = [];
            }
            if(!isset($_SESSION['productOrders'])) {
                  $_SESSION['productOrders'] = [];
            }
            if(isset($data['submit'])) {
                  // Sanitize
                  $productId = trim($data['product_id']) ?? null;
                  $quantity = trim($data['quantity']) ?? null;

                  $products = (new Product())->getProductById($productId);

                  if(!empty($products)) {

                        if($products['quantity'] < $quantity) {
                              Flash::set('error', "Only {$products['quantity']} stock is available.");
                              $this->redirectToPage('order', 'create');
                        }

                        $productsData = [
                              'product_id' => $products['id'],
                              'name' => $products['name'],
                              'image' => $products['image'],
                              'price' => $products['price'],
                              'quantity' => $quantity,
                        ];

                        if(!in_array($products['id'], $_SESSION['productOrderIds'])) {
                              array_push($_SESSION['productOrderIds'], $products['id']);
                              array_push($_SESSION['productOrders'], $productsData);
                        } else {
                              foreach($_SESSION['productOrders'] as $key => $productSessionOrder) {
                                    if($productSessionOrder['product_id'] == $products['id']) {
                                          $newQuantity = $productSessionOrder['quantity'] + $quantity;

                                          $productsData = [
                                                'product_id' => $products['id'],
                                                'name' => $products['name'],
                                                'image' => $products['image'],
                                                'price' => $products['price'],
                                                'quantity' => $newQuantity,
                                          ];
                                          $_SESSION['productOrders'][$key] = $productsData;
                                    }
                              }
                        }

                        Flash::set('success', "Order Added Successfully.");
                        $this->redirectToPage('order', 'create');

                  } else {
                        Flash::set('error', "Please select a product");
                        $this->redirectToPage('order', 'create');
                  }
            }
      }

      public function getAllProducts() {

      }

}