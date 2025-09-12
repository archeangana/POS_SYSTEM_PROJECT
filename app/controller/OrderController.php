<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Order;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Company;
use App\Core\Helpers\Flash;

class OrderController extends Controller {

      public function indexAction() {
            $this->view('admin/orders/index');
      }

     public function jsonResponse($status, $type, $message, $data = []) {
            if (ob_get_length()) ob_clean(); // Clear any accidental output

            // Correct Content-Type header
            header('Content-Type: application/json; charset=UTF-8');

            $response = [
                  'status'       => $status,
                  'status_type'  => $type,
                  'message'      => $message,
                  'data'         => $data
            ];

            echo json_encode(
                  $response,
                  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            );
            exit;
      }
      
      public function addAction($data) {
            if(!isset($_SESSION['productOrderIds'])) {
                  $_SESSION['productOrderIds'] = [];
            }
            if(!isset($_SESSION['productOrders'])) {
                  $_SESSION['productOrders'] = [];
            }
            if(isset($_POST['productIncDec'])) {
                  ob_start();
                  header('Content-Type: application/json');
                  $productId = trim($_POST['product_id']);
                  $quantity = trim($_POST['quantity']);

                  $flag = false;
                  foreach($_SESSION['productOrders'] as $key => $item) {
                        if($item['product_id'] == $productId) {
                              $flag = true;
                              $_SESSION['productOrders'][$key]['quantity'] = $quantity;

                              $price = $_SESSION['productOrders'][$key]['price'];
                              $itemTotal = $price * $quantity;
                              if($flag) {
                                    $this->jsonResponse(200, 'success', 'Quantity Updated', [
                                          'quantity' => $quantity,
                                          'item_total' => number_format($itemTotal, 0),
                                          'product_id' => $productId
                                    ]);
                              } else {
                                    $this->jsonResponse(301, 'error', 'Failed Quantity Update');
                              }
                              return;
                        } 
                  }
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

      public function createAction() {
            $productsData = (new Product())->getAll();
            $customerData = (new Customer())->getAll();
            if(empty($productsData)) {
                  $productsData = [];
            }
            $this->view('admin/orders/index', ['products' => $productsData, 'customers' => $customerData]);
      }


      public function deleteAction($data) {
            if (!isset($data['index']) || !is_numeric($data['index'])) {
                  Flash::set('error', "Invalid index.");
                  $this->redirectToPage('order', 'create');
                  return;
            }

            $index = (int)$data['index']; // now properly assigning the actual value

            if (isset($_SESSION['productOrders'][$index]) && isset($_SESSION['productOrderIds'][$index])) {
                  unset($_SESSION['productOrders'][$index]);
                  unset($_SESSION['productOrderIds'][$index]);

                  // Reindex arrays to prevent index gaps
                  $_SESSION['productOrders'] = array_values($_SESSION['productOrders']);
                  $_SESSION['productOrderIds'] = array_values($_SESSION['productOrderIds']);

                  Flash::set('success', "Order Removed.");
            } else {
                  Flash::set('error', "Delete Order Failed");
            }

            $this->redirectToPage('order', 'create');
      }

      public function getAllProducts() {

      }

      public function paymentAction($data) {
            ob_start();
            if(!empty($data)) {
                  if(isset($data['submit'])) {
                        // Sanitize
                        $payment_mode = htmlspecialchars(trim($data['payment_mode'])); 
                        $customer_phone = trim($data['customer_phone']); 
                        
                        // Check if customer exists
                        $customerData = (new Customer())->getCustomerByPhone($customer_phone);
                        if(isset($_SESSION['productOrders'])) {
                              if ($customerData) {
                                    $_SESSION['invoice_no'] = uniqid('INV-');
                                    $_SESSION['payment_method'] = $payment_mode;
                                    $_SESSION['customer_phone'] = $customer_phone;
                                    $this->jsonResponse(200, 'success', 'Customer Found', ['name' => $customerData['name']]);
                              } else {
                                    $this->jsonResponse(404, 'warning', 'Customer Not Found');
                              }
                        } else {
                              $this->jsonResponse(401, 'warning', 'Select an order first');
                        }
                       
                  }
            }
      }

      public function orderSummaryAction(array $data) {

            if(isset($_SESSION['customer_phone'])) {
                  $customer_phone = trim($_SESSION['customer_phone']);
                  $payment_method = htmlspecialchars(trim($_SESSION['payment_method']));
                  $invoice_no = trim($_SESSION['invoice_no']);
                  $product_orders = $_SESSION['productOrders'];

                  $grandTotal = 0;
                  $totalQuantity = 0;

                  foreach ($product_orders as $order) {
                        // Ensure numeric safety
                        $price = isset($order['price']) ? (float)$order['price'] : 0;
                        $qty = isset($order['quantity']) ? (int)$order['quantity'] : 0;

                        $totalPrice = $price * $qty;
                        $grandTotal += $totalPrice;
                        $totalQuantity += $qty;

                        // Store total price back if needed for the view
                        $order['total_price'] = $totalPrice;
                  }

                  $customer_data = (new Customer())->getCustomerByPhone($customer_phone);
                  $companyDetails = (new Company())->getCompanyDetails();
                  
                  if($customer_data) {
                        $this->view('admin/orders/index',  [
                              'data'           => $customer_data,
                              'companyDetails' => $companyDetails,
                              'invoice_no'     => $invoice_no,
                              'payment_method' => $payment_method,
                              'orders'         => $product_orders,
                              'grand_total'    => $grandTotal,
                              'total_quantity' => $totalQuantity
                        ]);
                  }          
             
            } else {
                  return [];
            }
      }

      public function createOrderAction(array $data){
            if (ob_get_length()) ob_clean();
            // Validate request
            if (isset($data['submit_order'])) {
                  
                  $customer_phone = trim($_SESSION['customer_phone']);
                  $payment_method = htmlspecialchars(trim($_SESSION['payment_method']));
                  $invoice_no = trim($_SESSION['invoice_no']);
                  $product_orders = $_SESSION['productOrders'];
                  $order_placed_by_id = $_SESSION['user_id'];

                  $grandTotal = 0;
                  $totalQuantity = 0;

                  foreach ($product_orders as &$order) {   // <-- note the &
                        $price = isset($order['price']) ? (float)$order['price'] : 0;
                        $qty   = isset($order['quantity']) ? (int)$order['quantity'] : 0;

                        $totalPrice = $price * $qty;
                        $grandTotal += $totalPrice;
                        $totalQuantity += $qty;

                        $order['price'] = $price;           // ensure key exists
                        $order['quantity'] = $qty;          // ensure key exists
                        $order['total_price'] = $totalPrice;
                  }
                  unset($order);

                  $customer_data = (new Customer())->getCustomerByPhone($customer_phone);

                  if($customer_data) {
                        $orderData = [
                              'customer_id'    => $customer_data['id'],
                              'tracking_no'    => 'TRK-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(6))),
                              'invoice_no'     => $invoice_no,
                              'total_amount'   => $grandTotal,
                              'order_status'   => 'pending', // or "booked" if you add it to ENUM
                              'payment_method' => $payment_method,
                              'created_by'     => $order_placed_by_id ?? null,
                        ];

                        $orderModel = new Order();
                        $order_tracking = $orderModel->create($orderData, $product_orders);
                        if($order_tracking) {
                              // Deleting the session data after successful order creation
                              unset($_SESSION['productOrders']);
                              unset($_SESSION['productOrderIds']);
                              unset($_SESSION['customer_phone']);
                              unset($_SESSION['payment_method']);
                              unset($_SESSION['invoice_no']);

                              return $this->jsonResponse(200, 'success', 'Order created successfully', $order_tracking);
                        } else {
                              return $this->jsonResponse(500, 'error', 'Failed to create order', $order_tracking);
                        }
                  } else {
                        return $this->jsonResponse(400, 'error', 'Customer Data not found');
                  }
            }

            return $this->jsonResponse(500, 'error', 'Server Error');
      }

      public function ordersAction($data) {

            // Select all from orders table

            $orderModel = new Order();
            $orders = [];

            if(!empty($data)) {
                  if(isset($data['date']) || isset($data['payment_status'])) {
                        $orders = $orderModel->filterOrders($data['date'], $data['payment_status']);
                        $this->view('admin/orders/index', ['orders' => $orders, 'date' => $data['date'], 'payment_status' => $data['payment_status']]);
                  } 
            } else{
                   $orders = $orderModel->getAllOrders();
                  if(empty($orders)) {
                        $orders = [];
                  }
                  $this->view('admin/orders/index', ['orders' => $orders]);
            }
      }

      public function viewAction($data) {
            if(isset($data['track']) && !empty($data['track'])) {
                  // Sanitize the tracking number
                  if (ob_get_length()) ob_clean(); // Clear any accidental output
                  $tracking_no = htmlspecialchars(trim($data['track']));
                  $orderModel = new Order();
                  $orderData = $orderModel->getOrderByTrackingNo($tracking_no);
                  $orderItemsData = $orderModel->getOrderItemsByTrackingNo($tracking_no);
                  
                  if($orderData && $orderItemsData) {
                        $this->view('admin/orders/index', ['order' => $orderData, 'orderItems' => $orderItemsData]);
                  } else {
                        Flash::set('error', "Order not found.");
                        $this->redirectToPage('order', 'orders');
                  }
            } else {
                  Flash::set('error', "Invalid tracking number.");
                  $this->redirectToPage('order', 'orders');
            }
      }

      public function printAction($data) {

            if(!empty($data) && isset($data)) {
                  $tracking_no = htmlspecialchars(trim($data['track']));

                  if(!empty($tracking_no)) {
                        $orderModel = new Order();
                        $orderDataForPrint = $orderModel->getOrderByTrackingNo($tracking_no);
                        $orderItemsDataForPrint = $orderModel->getOrderItemsByTrackingNo($tracking_no);

                        if($orderDataForPrint && $orderItemsDataForPrint) {   
                              http_response_code(200);
                              $this->view('admin/orders/index', ['data' => $orderDataForPrint, 'orders' => $orderItemsDataForPrint]);
                        }
                  } else {
                        http_response_code(404);
                        Flash::set('error', 'Order Not found');
                        $this->redirectToPage('order', 'orders');
                  }
            } else {
                  Flash::set('error', 'Tracking No is empty');
                  http_response_code(500);
                  $this->redirectToPage('order', 'orders');
            }

      }
}