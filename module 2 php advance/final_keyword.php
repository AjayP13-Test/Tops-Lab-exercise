<?php
class Base {
    final public function display() {
        echo "This cannot be overridden";
    }
}

class Child extends Base {
    // Cannot override display()
}

$obj = new Child();
$obj->display();
?>
