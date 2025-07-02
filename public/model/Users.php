<?php

      require_once "./config/database.php";

      class User extends Database {

            protected function getUsersData() {
                  $query = "SELECT * FROM users";
                  $stmt = $this->connect()->prepare($query);
                  $stmt->execute();
                  $users = $stmt->fetchAll();
                  
                  foreach ($users as $user) {
                        echo "ID: {$user['id']}, Name: {$user['first_name']} {$user['last_name']}, Age: {$user['age']}<br>";
                  }
            }

            protected function addUser($id, $first_name, $last_name, $age) {
                  $query = "INSERT INTO users(id, first_name, last_name, age) VALUES (?, ?, ?, ?)";
                  $stmt = $this->connect()->prepare($query);
                  $stmt->execute([$id, $first_name, $last_name, $age]);
            }

            protected function updateUser($id, $first_name, $last_name, $age) {
                  $query = "UPDATE users SET first_name = ?, last_name = ?, age = ? WHERE id = ?";
                  $stmt = $this->connect()->prepare($query);
                  $stmt->execute([$first_name, $last_name, $age, $id]);
            }

            protected function deleteUser($id) {
                  $query = "DELETE FROM users WHERE id = ?";
                  $stmt = $this->connect()->prepare($query);
                  $stmt->execute([$id]);
            }
      }