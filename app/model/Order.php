<?php

namespace App\Model;
use App\Http\Database;
use App\Model\Product;
use PDO;

class Order extends Database {

      private $table = 'orders';
      
      public function getAllOrder() {
          
      }

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

                  // Update Stock
                  $stockQuery = "UPDATE products 
                       SET quantity = quantity - :qty 
                       WHERE id = :product_id AND quantity >= :qty"; 
                  $stockStmt = $pdo->prepare($stockQuery);

                  foreach ($items as $item) {
                         $itemStmt->execute([
                              ':order_id'   => $orderId,
                              ':product_id' => $item['product_id'],
                              ':price'      => $item['price'],
                              ':quantity'   => $item['quantity'],
                        ]);

                        // Deduct stock
                        $stockStmt->execute([
                              ':product_id' => $item['product_id'],
                              ':qty'   => $item['quantity'],
                        ]);

                        // ⚠️ Check if stock was updated (if not, rollback)
                        if ($stockStmt->rowCount() === 0) {
                              throw new Exception("Not enough stock for product ID " . $item['product_id']);
                        }
                  }

                  $pdo->commit();
                  return $orderId; // return order_id for reference

            } catch (\PDOException $e) {
                  $pdo->rollBack();
                  error_log('Create Order Failed: ' . $e->getMessage());
                  return false;
            }
      }


}