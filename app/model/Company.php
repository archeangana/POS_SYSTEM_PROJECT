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
                        $query = "SELECT id, site_name, company_name, company_address FROM {$this->table} LIMIT 1";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        return $stmt->fetch();
                  }
            } catch(PDOException $e) {
                  http_response_code(500);
                  throw new PDOException("Error: " . $e->getMessage());
                  die();
            }
      }

      public function updateCompanyDetails($data) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "UPDATE {$this->table} 
                              SET 
                                    site_name = :site_name, 
                                    company_name = :company_name, 
                                    company_address = :company_address
                              WHERE id = :id";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':site_name', $data['site_name']);
                        $stmt->bindParam(':company_name', $data['company_name']);
                        $stmt->bindParam(':company_address', $data['company_address']);
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