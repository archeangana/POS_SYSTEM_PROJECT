<?php

class Product {
      private $price;
      private $weight;

      public function __construct($price, $weight) {
            $this->price = $price;
            $this->weight = $weight;
      }

      public function getPrice(){
            return $this->price;
      }

      public function getWeight(){
            return $this->weight;
      }
}

class Shipping {
      private $totalShippingPrice;
      private $products;
      private $pricePerKilogram;

      public function __construct($pricePerKilogram) {
            $this->pricePerKilogram = $pricePerKilogram;
      }

      public function addProducts(Product $product) {
            $this->products[] = $product;
      }

      public function calculateShipping() {
            foreach($this->products as $product){
                  $this->totalShippingPrice += $product->getWeight() * $this->pricePerKilogram;
            }
      }

      public function getTotalShippingPrice() {
            return $this->totalShippingPrice;
      }
}

$pricePerKilogram = 5;
$product1 = new Product(100, 2);
$product2 = new Product(44, 10);
$product3 = new Product(12, 6);

$shipping = new Shipping($pricePerKilogram);
$shipping->addProducts($product1);
$shipping->addProducts($product2);
$shipping->addProducts($product3);
$shipping->calculateShipping();

$totalShippingPrice = $shipping->getTotalShippingPrice();
echo "Total shipping price for product 1: $totalShippingPrice\n <br/>";
