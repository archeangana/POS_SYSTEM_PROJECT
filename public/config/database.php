<?php

class Database {

      private $host = "localhost";
      private $user = "root";
      private $password = "";
      private $dbname = "cms_db"; 


      protected function connect() {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            try {
                  $pdo = new PDO($dsn, $this->user, $this->password);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                  return $pdo;
            } catch (PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
            }
      }

}
