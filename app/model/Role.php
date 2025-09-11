<?php

namespace App\Model;
use App\Http\Database;
use PDOException;
use PDO;

class Role extends Database {
      private $table = 'roles';

      public function getAllRoles() {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table}";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  return $result;

            } catch(PDOException $e) {
                  http_response_code(500);
                  throw new PDOException('Failed to fetch Roles Data: ', $e->getMessage());
            }
      }

      public function getRoleById($id) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT name FROM {$this->table} WHERE id = :id LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute(':id', $id);
                  $result = $stmt->fetch();
                  return $result;
                  
            } catch(PDOException $e) {
                  http_response_code(500);
                  throw new PDOException('Failed to fetch role by id: ', $e->getMessage());
            }
      }
}
