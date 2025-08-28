<?php
class Vehicle {
    public $brand;
    public function __construct($brand) {
        $this->brand = $brand;
    }
    public function drive() {
        echo "Driving a vehicle";
    }
}

class Car extends Vehicle {
    public function drive() {
        echo "Driving a car: " . $this->brand;
    }
}

$car = new Car("Honda");
$car->drive();
?>
