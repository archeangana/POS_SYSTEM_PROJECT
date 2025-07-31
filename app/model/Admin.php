<?php

namespace App\Model;
use App\Http\Database;

class Admin extends Database {

      private $table = 'admins';

      public function addAdmin($data) {
            try {
                  $pdo = $this->connect();
                  $query = "INSERT INTO {$this->table} (name, password, email, phone, is_ban) VALUES (:name, :password, :email, :phone, :is_ban)";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':name', $data['name']);
                  $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_BCRYPT));
                  $stmt->bindParam(':email', $data['email']);
                  $stmt->bindParam(':phone', $data['phone']);
                  $stmt->bindParam(':is_ban', $data['is_ban']);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  return 'Add Admin Failed' . $e->message();
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
                  return 'Admin not found' . $e->message();
            }
      }

      public function getAllAdmins() {
            try {

                  $pdo = $this->connect();
                  $query = "SELECT * FROM {$this->table}";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute();
                  return $stmt->fetchAll();

            } catch(PDOException $e) {
                  return 'Admin not found' . $e->message();
            }
      }

      public function deleteAdmin($id) {
            try {
                  $pdo = $this->connect();
                  $query = "DELETE FROM {$this->table} WHERE id=:id";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':id', $id);
                  return $stmt->execute();

            } catch(PDOException $e) {
                  return 'Admin not found' . $e->message();
            }
      }

}