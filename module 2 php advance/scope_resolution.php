<?php
class ParentClass {
    public static function greet() {
        echo "Hello from Parent";
    }
}

class ChildClass extends ParentClass {
    public static function greet() {
        parent::greet();
        echo " and Hello from Child";
    }
}

ChildClass::greet();
?>
