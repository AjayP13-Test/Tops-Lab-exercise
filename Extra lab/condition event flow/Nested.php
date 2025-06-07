<?php

$number = 3;

if ($number > 0) {
    echo "The number is positive. ";

    if ($number % 2 == 0) {
        echo "It is even.";
    } else {
        echo "It is odd.";
    }

} elseif ($number < 0) {
    echo "The number is negative. ";

    if ($number % 2 == 0) {
        echo "It is even.";
    } else {
        echo "It is odd.";
    }

} else {
    echo "The number is zero.";
}
?>
