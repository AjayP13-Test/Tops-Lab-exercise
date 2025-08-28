<?php
class Order {
    public function placeOrder(string $item, int $qty) {
        echo "Order placed: $item (Qty: $qty)";
    }
}

$o = new Order();
$o->placeOrder("Laptop", 2);
?>
