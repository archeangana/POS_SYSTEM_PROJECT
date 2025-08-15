<?php

namespace App\Model;
use App\Http\Database;
use App\Model\Product;
use PDO;

class Order extends Database {

      private $table = 'orders';
      
      public function getAllOrder() {
          
      }

      public function create(array $data) {
            try {
                  $pdo = $this->connect();
                  $query = "INSERT INTO {$this->table} (customer_id, tracking_no, invoice_no, total_amount, order_date, order_status, payment_method) VALUES (:customer_id, :tracking_no, :invoice_no, :total_amount, :order_date, :order_status, :payment_method)";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':customer_id', $data['customer_id'], PDO::PARAM_INT);
                  return [];

            } catch(\PDOException $e) {
                  error_log('Create Order Failed: ' . $e->getMessage());
                  return [];
            }
      }


}