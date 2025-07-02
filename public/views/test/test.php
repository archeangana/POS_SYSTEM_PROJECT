<?php
      declare(strict_types=1);
      require_once "./config/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Test</title>
      <style>

            h1 {
                  --status: red;
                  color:  var(--status);
            }

      </style>
</head>
<body>
      <?php 
            $test = new TestController();
            echo "<a href='/'>" . $test->setTest() . "</a>";

            echo Test::getCount();

      ?>

      <div>
            <h1 data-status="red">Hello</h1>
      </div>

      <form action="?page=test" method="post">
            <input type="number" name="number1" placeholder="Enter first number" required>
            <select name="operator" id="">
                  <option value="add">Addition</option>
                  <option value="subtract">Subtraction</option>
                  <option value="divide">Division</option>
                  <option value="multiply">Multiply</option>
            </select>
            <input type="number" name="number2" placeholder="Enter second number" required>
            <button type="submit">Calculate</button>
      </form>

      <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  $number1 = $_POST['number1'];
                  $number2 = $_POST['number2'];
                  $operator = $_POST['operator'];

                  try {
                        $calculate = new Calculate($operator, (int) $number1, (int) $number2);
                        $result = $calculate->calculate();
                        echo "<h3>Result: {$result}</h3>";
                  } catch (Exception $e) {
                        echo "<h3>Error: " . $e->getMessage() . "</h3>";
                  }
            }

            // $test = new Test();
            // echo "<br> Test Name: " . Test::WORLD . "<br>";

            // echo "Value from parent: " . TestSecond::getConstParent();
            // echo "<br> My full name: " . ucfirst(TestSecond::getFullName());

            $paymentMethod = new CreditCard();
            $payment = new PayNow();
            echo "<br>" . $payment->pay($paymentMethod);
            echo "<br>" . ucfirst($paymentMethod->getBuyerName());


            $sample = new class('arche angana',23, 'Male') {
                  public string $name;
                  public int $age;
                  public string $gender;

                  public function __construct($name, $age, $gender) {
                        $this->name = $name;
                        $this->age = $age;
                        $this->gender = $gender;
                  }

                  public function getFullName(): string {
                        return "My Fullname is: " . ucwords($this->name) . ", I am " . strtoupper((string) $this->age) . " years old" . " I am a " . $this->gender;
                  }
            };

            echo "<br>" . $sample->getFullName();

            class SampleTest extends Database {

                  public function getUsersData() {
                        $query = "SELECT * FROM users";
                        $stmt = $this->connect()->query($query);

                        while($row = $stmt->fetch()) {
                              echo "<br> Name: {$row['first_name']} {$row['last_name']}";
                        }
                  }

                  public function getUserByName($first_name){
                        
                        $query = "SELECT * FROM users WHERE first_name = ?";
                        $stmt = $this->connect()->prepare($query);
                        $stmt->execute([$first_name]);
                        $names = $stmt->fetchAll();

                        foreach($names as $name){
                              echo "<br>" . $name['first_name'] . " " .$name['last_name'] . "<br>";
                        }
                  }

                  public function addUser($first_name, $last_name, $age){
                        $query = "INSERT INTO users(first_name, last_name, age)
                              VALUES (?, ?, ?)";
                        $stmt = $this->connect()->prepare($query);
                        $stmt->execute([$first_name, $last_name, $age]);
                  }

                  public function updateUser($id, $first_name, $last_name, $age) {
                        $query = "UPDATE users SET first_name = ? , last_name = ?, age = ? WHERE id = ?";
                        $stmt = $this->connect()->prepare($query);
                        $stmt->execute([$first_name, $last_name, $age, $id]);
                  }

                  public function deleteUser($id) {
                        $query = "DELETE FROM users WHERE id = ?";
                        $stmt = $this->connect()->prepare($query);
                        $stmt->execute([$id]);
                  }
            }

                  $sampleTest = new SampleTest();
                  $sampleTest->getUsersData();
  

      ?>
      
</body>
</html>