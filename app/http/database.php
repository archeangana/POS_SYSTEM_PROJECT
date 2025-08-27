<?php

namespace App\Http;
use PDO;
use PDOException;

class Database {
      private $host = 'localhost';
      private $db_name = 'pos_db';
      private $username = 'root';
      private $password = '';

      protected function connect() {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name}";
            $options = [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  PDO::ATTR_EMULATE_PREPARES => false,
            ];
            try {
                  $pdo = new PDO($dsn, $this->username, $this->password, $options);
                  return $pdo;
            } catch(PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                  die();
            }
      }
}