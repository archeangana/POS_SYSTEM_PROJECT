<?php


namespace App\Model;
use App\Http\Database;
use PDO;
use PDOException;

class Customer extends Database {

      private $table = 'customers';

      public function create($data) {
            try {
                  $pdo = $this->connect();
                  $query = "INSERT INTO {$this->table} (name, email, phone, status) VALUES (:name, :email, :phone, :status)";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
                  $stmt->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
                  $stmt->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
                  return false;
            }
      }

      public function getAll() {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table}";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  return $stmt->fetchAll();
            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
                  return false;
            }
      }

      public function getCustomerById($id){
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} WHERE id=:id LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                  return $stmt->fetch();
            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
                  return false;
            }
      }

      public function getCustomerByEmail($email) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} WHERE email=:email LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                  $stmt->execute();
                  return $stmt->fetch();
            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
                  return false;
            }
      }

      public function getCustomerByPhone($phone) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} WHERE phone=:phone LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                  $stmt->execute();
                  $result = $stmt->fetch();
                  return $result ? $result : [];
            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
                  return [];
            }
      }

      public function update($data) {
            try {
                  $pdo = $this->connect();
                  $query = "UPDATE {$this->table} SET name=:name, email=:email, phone=:phone, status=:status WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
                  $stmt->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
                  $stmt->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
       
                  return false;
            }
      }

      public function delete($id){
            try {
                  $pdo = $this->connect();
                  $query = "DELETE FROM {$this->table} WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  error_log('Failed to create customer' . $e->getMessage());
                  return false;
            }
      }

}