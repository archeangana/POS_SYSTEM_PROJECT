<?php

namespace App\Model;
use App\Http\Database;
use App\Model\Order;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Category;
use App\Model\Admin;
use PDOException;

class Analytics extends Database {

      public function getCount(string $tableName): int
      {
            // Whitelist allowed tables to avoid SQL injection
            $allowedTables = ['orders', 'customers', 'products', 'admins']; 

            if (!in_array($tableName, $allowedTables, true)) {
                  throw new \Exception("Invalid table name: {$tableName}");
            }

            try {
                  $pdo = $this->connect();
                  $query = "SELECT COUNT(*) AS total FROM {$tableName}";
                  $stmt = $pdo->query($query);
                  $result = $stmt->fetch();
                  return (int) $result['total'];

            } catch (\PDOException $e) {
                  error_log('Get Count Failed: ' . $e->getMessage());
                  return 0;
            }
      }
}