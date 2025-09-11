<?php

namespace App\Model;
use App\Http\Database;
use PDO;
use PDOException;

class Admin extends Database {

      private $table = 'admins';

      public function addAdmin($data) {
            try {
                  $pdo = $this->connect();
                  $query = "INSERT INTO {$this->table} (name, password, email, phone, role_id) VALUES (:name, :password, :email, :phone, :role_id)";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_BCRYPT));
                  $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
                  $stmt->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
                  $stmt->bindParam(':role_id', $data['role_id'], PDO::PARAM_INT);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  throw new PDOException('Add Admin Failed' . $e->getMessage());
            }
      }

      public function getAdminByEmail($email) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} WHERE email=:email LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':email', $email);
                  $stmt->execute();
                  return $stmt->fetch();

            } catch(PDOException $e) {
                  return 'Admin not found' . $e->getMessage();
            }
      }
      
      public function getAdminById($id) {
            try {
                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table} 
                              WHERE id=:id 
                              LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id);
                  $stmt->execute();
                  return $stmt->fetch();

            } catch(PDOException $e) {
                  return 'Admin not found' . $e->getMessage();
            }
      }

      public function getAllAdmins() {
            try {

                  $pdo = $this->connect();
                  $query = "SELECT a.*, r.name as role_name FROM {$this->table} a INNER JOIN roles r ON r.id = a.role_id ORDER BY id ASC";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  return $stmt->fetchAll();

            } catch(PDOException $e) {
                  return 'Admin not found' . $e->getMessage();
            }
      }

      public function updateAdmin($data) {
            try {
                  $pdo = $this->connect();
                  $query = "UPDATE {$this->table} SET name=:name, email=:email, password=:password, phone=:phone, role_id=:role_id WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  // Sanitize and Bind Values
                  $stmt->bindParam(':id', $data['id'], PDO::PARAM_STR);
                  $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                  $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
                  $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_BCRYPT), PDO::PARAM_STR);
                  $stmt->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
                  $stmt->bindParam(':role_id', $data['role_id'], PDO::PARAM_INT);
                  return $stmt->execute();
            } catch(PDOException $e) {
                  return 'Admin not Found' . $e->getMessage();
            }
      }

      public function deleteAdmin($id) {
            try {
                  $pdo = $this->connect();
                  $query = "DELETE FROM {$this->table} WHERE id=:id LIMIT 1";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  return 'Admin not found' . $e->getMessage();
            }
      }

}