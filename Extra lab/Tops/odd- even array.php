<?php

$numbers = [45, 41, 22, 64, 53, 85, 77, 97, 90, 101];


$evenCount = 0;
$oddCount = 0;


foreach ($numbers as $num) {
    if ($num % 2 == 0) {
        $evenCount++;
    } else {
        $oddCount++;
    }
}

echo "Total even numbers: $evenCount<br>";
echo "Total odd numbers: $oddCount";
?>
