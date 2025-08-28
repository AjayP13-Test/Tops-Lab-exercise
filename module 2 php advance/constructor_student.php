<?php
class Student {
    public $name;
    public $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function display() {
        echo "Student: $this->name, Age: $this->age";
    }
}

$s1 = new Student("Ajay", 22);
$s1->display();
?>
