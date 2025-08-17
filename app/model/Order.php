<?php

namespace App\Model;
use App\Http\Database;
use App\Model\Product;
use PDO;

class Order extends Database {

      private $table = 'orders';

      public function create(array $orderData, array $items) {
            
            try {
                  $pdo = $this->connect();
                  $pdo->beginTransaction();

                  // Insert order
                  $query = "INSERT INTO {$this->table} 
                        (customer_id, tracking_no, invoice_no, total_amount, order_status, payment_method, created_by) 
                        VALUES (:customer_id, :tracking_no, :invoice_no, :total_amount, :order_status, :payment_method, :created_by)";
                  
                  $stmt = $pdo->prepare($query);
                  $stmt->execute([
                        ':customer_id'   => $orderData['customer_id'],
                        ':tracking_no'   => $orderData['tracking_no'],
                        ':invoice_no'    => $orderData['invoice_no'],
                        ':total_amount'  => $orderData['total_amount'],
                        ':order_status'  => $orderData['order_status'],
                        ':payment_method'=> $orderData['payment_method'],
                        ':created_by'    => $orderData['created_by'],
                  ]);

                  // Get the newly created order id
                  $orderId = $pdo->lastInsertId();

                  // Insert order items
                  $itemQuery = "INSERT INTO order_items (order_id, product_id, price, quantity) 
                              VALUES (:order_id, :product_id, :price, :quantity)";
                  $itemStmt = $pdo->prepare($itemQuery);

                  // Deduct stock
                  $stockQuery = "UPDATE products 
                       SET quantity = quantity - :qty 
                       WHERE id = :product_id AND quantity >= :minQty"; 
                  $stockStmt = $pdo->prepare($stockQuery);

                  foreach ($items as $item) {
                         $itemStmt->execute([
                              ':order_id'   => $orderId,
                              ':product_id' => $item['product_id'],
                              ':price'      => $item['price'],
                              ':quantity'   => $item['quantity'],
                        ]);

                 
                        $stockStmt->execute([
                              ':product_id' => $item['product_id'],
                              ':qty'   => $item['quantity'],
                              ':minQty'   => $item['quantity'],
                        ]);

                        // ⚠️ Check if stock was updated (if not, rollback)
                        if ($stockStmt->rowCount() === 0) {
                              throw new Exception("Not enough stock for product ID " . $item['product_id']);
                        }
                  }

                  $pdo->commit();
                  return ['order_tracking' => $orderData['tracking_no']]; // return order_id for reference

            } catch (\PDOException $e) {
                  $pdo->rollBack();
                  // error_log("Params: " . print_r($orderData, true));
                  // error_log("Params: " . print_r($items, true));
                  error_log('Create Order Failed: ' . $e->getMessage());
                  return [];
            }
      }

      public function getAllOrders() {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT 
                              o.id AS order_id,
                              o.tracking_no,
                              o.invoice_no,
                              o.total_amount,
                              o.order_status,
                              o.payment_method,
                              o.created_at,
                              c.id AS customer_id,
                              c.name AS customer_name,
                              c.phone AS customer_phone,
                              c.email AS customer_email
                              FROM {$this->table} o
                              INNER JOIN customers c ON o.customer_id = c.id
                              ORDER BY o.created_at DESC";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  return $result;
            } catch(\PDOException $e) {
                  error_log('Get All Orders Failed: ' . $e->getMessage());
                  return [];
            }
      }


}