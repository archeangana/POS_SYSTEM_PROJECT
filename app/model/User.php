<?php

namespace App\Model;
use App\Http\Database;


class User extends Database {
      private $table = 'users';

      public function getUsers() {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                         $query = "SELECT * FROM {$this->table}";
                        $stmt = $pdo->prepare($query);
                        $stmt = $pdo->execute();
                        return $stmt->fetchAll();
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
          
      }

      public function loginUser($data) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "SELECT * FROM {$this->table} WHERE email = :email";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':email', $data['email']);
                        $stmt->execute();
                        $user = $stmt->fetch();
                        
                        if ($user && password_verify($data['password'], $user['password'])) {
                              session_start();
                              $_SESSION['user_id'] = $user['id'];
                              $_SESSION['user_name'] = $user['name'];
                              $_SESSION['is_logged_in'] = true;
                              return $user;
                        } else {
                              return false;
                        }
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      }

      public function getUserByEmail($email) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "SELECT * FROM {$this->table} WHERE email = :email";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                        return $stmt->fetch();
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      } 

      public function createUser($data) {
            try {
                  $pdo = $this->connect();
                  if($pdo) {
                        $query = "INSERT INTO {$this->table} (username, email, password, confirm_password) VALUES (:username, :email, :password, :confirm_password)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':username', $data['username']);
                        $stmt->bindParam(':email', $data['email']);
                        $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT));
                        $stmt->bindValue(':confirm_password', password_hash($data['confirm_password'], PASSWORD_DEFAULT));
                        return $stmt->execute();
                  } else {
                        return false;
                  }
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  die();
            }
      }


}