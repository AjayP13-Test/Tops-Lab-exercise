<?php
class Magic {
    public function __get($name) {
        return "Property '$name' not found.";
    }
    public function __set($name, $value) {
        echo "Setting '$name' to '$value'<br>";
    }
    public function __call($name, $args) {
        echo "Method '$name' not found.<br>";
    }
}

$obj = new Magic();
echo $obj->abc;
$obj->xyz = 10;
$obj->foo();
?>
