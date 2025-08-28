<?php
class Calculator {
    public function __call($name, $arguments) {
        if($name == 'add') {
            return array_sum($arguments);
        }
    }
}

$calc = new Calculator();
echo "Sum: " . $calc->add(2, 3, 5);
?>
