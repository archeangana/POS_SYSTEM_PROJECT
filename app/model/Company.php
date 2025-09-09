<?php

namespace App\Model;
use App\Http\Database;
use PDOException;
use PDO;

class Company extends Database {
      private $table = 'company';

      public function getCompanyDetails() {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "SELECT * FROM {$this->table} LIMIT 1";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        return $stmt->fetch();
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      }

      public function createCompanyDetails($data) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "INSERT INTO {$this->table} (name, email, phone, address) VALUES (:name, :email, :phone, :address)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':name', $data['name']);
                        $stmt->bindParam(':email', $data['email']);
                        $stmt->bindParam(':phone', $data['phone']);
                        $stmt->bindParam(':address', $data['address']);
                        return $stmt->execute();
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      }

      public function updateCompanyDetails($data) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "UPDATE {$this->table} SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':name', $data['name']);
                        $stmt->bindParam(':email', $data['email']);
                        $stmt->bindParam(':phone', $data['phone']);
                        $stmt->bindParam(':address', $data['address']);
                        $stmt->bindParam(':id', $data['id']);
                        return $stmt->execute();
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      }

      public function deleteCompany($id) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "DELETE FROM {$this->table} WHERE id = :id";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':id', $id);
                        return $stmt->execute();
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      }
}