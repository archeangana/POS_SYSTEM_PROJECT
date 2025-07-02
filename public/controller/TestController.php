<?php
declare(strict_types=1);
class TestController extends Controller {

      private $action;

      public function indexAction() {
            return include './views/test/test.php';
      }

      public function setTest() {
            $action = "Hello from TestController!";
            return $action;
      }

}

abstract class PaymentMethod {
      public string $name;

      public function getBuyerName(): string {
            $this->name = 'arche';
            return $this->name;
      }

      abstract public function processPayment(float $amount): string;
}

class Paypal extends PaymentMethod {
      public function processPayment(float $amount): string {
            return "Payment of {$amount} processed via Paypal.";
      }
}

class CreditCard  extends PaymentMethod {
      public function processPayment(float $amount): string {
            return "Payment of {$amount} processed via Credit Card.";
      }
}

class Gcash extends PaymentMethod {

      public function processPayment(float $amount): string {
            return "Payment of {$amount} processed via Gcash.";
      }
}

class PayNow {
      public function pay(PaymentMethod $paymentAmount): string{
            return $paymentAmount->processPayment(100.00);
      }
}

class Test {

      public static $count = 0;
      public $name = 'arche';
      public $age = 23;

      const WORLD = 'blue';

      public static function getCount() {
            return self::$count += 1;
      }
}

class TestSecond extends Test {

      public static $full_name = 'arche second';

      public static function getConstParent() {
            return parent::WORLD;
      }

      public static function getFullName() {
            return self::$full_name;
      }

}

class Calculate{
      public $operator;
      public $number1;
      public $number2;

      public function __construct(string $operator, int $number1, int $number2) {
            $this->operator = $operator;
            $this->number1 = $number1;
            $this->number2 = $number2;
      }

      public function calculate() {
            switch ($this->operator) {
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
                        throw new Exception("Invalid operator: " . $this->operator);
            }
      }     
}



