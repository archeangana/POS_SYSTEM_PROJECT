<?php

class Database {
      private $host = 'localhost';
      private $db_name = 'cms_project';
      private $username = 'root';
      private $password = '';

      protected function connect() {
            $dsn = "
                        mysql:host={$this->host};
                        dbname={$this->db_name}
                  ";
            $options = [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  PDO::ATTR_EMULATES_PREPARES => false,
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