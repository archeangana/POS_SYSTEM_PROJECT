<?php

class Person {
      public $name;
      public $age;
      public $gender;

      public static $isActive;

      public function __construct($name, $age, $gender) {
            $this->name = $name;
            $this->age = $age;
            $this->gender = $gender;
      }

      public static function setIsActive($status){
            self::$isActive = $status;
      }

      public static function getIsActive(){
            return self::$isActive;
      }

      public function getDetails(){
            return "Name: {$this->name} \n" .
                  "Age: {$this->age} years old \n" .
                  "Gender: {$this->gender}";
      }
}

class Calcualte {
      public $opetator;
      public $number1;
      public $number2;

      public function __construct($opetator, $number1, $number2) {
            $this->opetator = $opetator;
            $this->number1 = $number1;
            $this->number2 = $number2;
      }

      public function calculate() {
            switch ($this->opetator) {
                  case 'add':
                        return $this->number1 + $this->number2;
                  case 'subtract':
                        return $this->number1 - $this->number2;
                  case 'multiply':
                        return $this->number1 * $this->number2;
                  case 'divide':
                        if ($this->number2 != 0) {
                              return $this->number1 / $this->number2;
                        } else {
                              throw new Exception("Division by zero is not allowed.");
                        }
                  default:
                        throw new Exception("Invalid operator: " . $this->opetator);
            }
      }
}

class Test {
      public $name = 'Arche';
      public $age = 23;
}