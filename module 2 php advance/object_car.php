<?php
class Car {
    public $make;
    public $model;
    public $year;

    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    public function display() {
        echo "Car: $this->make $this->model ($this->year)";
    }
}

$car = new Car("Toyota", "Corolla", 2020);
$car->display();
?>
