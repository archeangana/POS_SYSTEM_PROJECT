<?php

namespace App\Model;
use App\Http\Database;
use PDO;

class Product extends Database {

      private $table = 'products';
      
      public function create($data) {
            try {
                  $pdo = $this->connect();
                  $query = "INSERT INTO {$this->table} (category_id, name, description, price, quantity,image, status) 
                              VALUES (:category_id, :name, :description, :price, :quantity, :image, :status )";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
                  $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
                  $stmt->bindParam(':quantity', $data['quantity'], PDO::PARAM_INT);
                  $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
                  $stmt->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                  return $stmt->execute();
            } catch(PDOExceptin $e) {
                  error_log('Failed to create product' . $e->getMessage());
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
                  error_log('Failed to create product' . $e->getMessage());
                  return false;
            }
      }

      public function update($data) {
            try {
                  $pdo = $this->connect();
                  $query = "UPDATE {$this->table} SET category_id=:category_id, name=:name, description=:description, price=:price, quantity=:quantity, image=:image, status=:status WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
                  $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
                  $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
                  $stmt->bindParam(':quantity', $data['quantity'], PDO::PARAM_INT);
                  $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
                  $stmt->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                  return $stmt->execute();
                
            } catch(PDOException $e) {
                  error_log('Failed to create product' . $e->getMessage());
                  return false;
            }
      } 

      public function getProductById($id) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} WHERE id=:id LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                  return $stmt->fetch();

            } catch(PDOException $e) {
                  error_log('Failed to create product' . $e->getMessage());
                  return false;
            }
      }

      public function delete($id) {
            $id = $id ?? '';
            if(isset($id) && !empty($id)) {
                  try {
                        $pdo = $this->connect();
                        $query = "DELETE FROM {$this->table} WHERE id=:id";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        return  $stmt->execute();

                  } catch(PDOExceptin $e) {
                        error_log('Failed to Delete product' . $e->getMessage());
                        return false;
                  }
            }
      }
}