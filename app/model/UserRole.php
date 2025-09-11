<?php

namespace App\Model;
use App\Http\Database;
use PDOException;

class UserRole extends Database {
      private $table = 'user_roles';
      
      public function getAllRoles() {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} ORDER BY id ASC";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  return $stmt->fetchAll();

            } catch(PDOException $e) {
                  throw new PDOException("Database error: " . $e->getMessage());
            }
      }
      
      public function getRoleByUserId($userId) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT ur.user_id, r.name FROM {$this->table} as ur
                              INNER JOIN users as u ON ur.user_id = u.id
                              INNER JOIN roles as r ON ur.role_id = r.id
                              WHERE u.id = :userId";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute(['userId' => $userId]);
                  return $stmt->fetch();

            } catch(PDOException $e) {
                  throw new PDOException("Database error: " . $e->getMessage());
            }
      }
}