<?php

namespace App\Model;
use App\Http\Database;
use PDO;

class Category extends Database {

      private $table = 'categories';

      public function createCategory($data) {
            try {
                  $pdo = $this->connect();
                  $query = "INSERT INTO {$this->table} (name, description, status) VALUES (:name, :description,:status)";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
                  $stmt->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  error_log('failed to create category' . $e->getMessage());
                  return false;
            }
      }

      public function getAll() {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} ORDER BY id ASC";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  return $stmt->fetchAll();

            } catch(PDOException $e) {
                  error_log('failed to create category' . $e->getMessage());
                  return false;
            }
      }

      public function getCategoryById($id) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} WHERE id=:id LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                  return $stmt->fetch();

            }catch(PDOException $e) {
                  error_log('Failed to get category by Id' . $e->getMessage());
                  return false;
            }
      }

      public function updateCategory($data) {
            try {
                  $pdo = $this->connect();
                  $query = "UPDATE {$this->table} SET name=:name, description=:description, status=:status WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
                  $stmt->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                  $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
                  $stmt->execute();

            } catch(PDOException $e) {
                  error_log('Failed to update category' . $e->getMessage());
                  return false;
            }
      }

      public function deleteCategory($id) {
            try {
                  $pdo = $this->connect();
                  $query = "DELETE FROM {$this->table} WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  error_log('Failed to delet category' . $e->getMessage());
                  return false;
            }
      }


}