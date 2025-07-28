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

                              // Optional: regenerate session ID to prevent session fixation attacks
                              session_regenerate_id(true);
                              // Return user data for further use
                              unset($user['password']); // Remove password from user data
                              unset($user['confirm_password']); // Remove confirm_password from user data
                              $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Regenerate CSRF token
                              $_SESSION['is_logged_in'] = true; // Set login status
                              $_SESSION['user_id'] = $user['id']; // Store user ID in session
                              $_SESSION['user'] = $user; // Store user data in session
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
                        $query = "INSERT INTO {$this->table} (username, email, password, confirm_password, csrf_token) VALUES (:username, :email, :password, :confirm_password, :csrf_token)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':username', $data['username']);
                        $stmt->bindParam(':email', $data['email']);
                        $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_BCRYPT));
                        $stmt->bindValue(':confirm_password', password_hash($data['confirm_password'], PASSWORD_BCRYPT));
                        $stmt->bindParam(':csrf_token', $data['csrf_token']);
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