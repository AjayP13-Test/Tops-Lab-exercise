<?php
// 
$marks = 85;

if ($marks >= 90 && $marks <= 100) {
    echo "Grade: A";
} elseif ($marks >= 80) {
    echo "Grade: B";
} elseif ($marks >= 70) {
    echo "Grade: C";
} elseif ($marks >= 60) {
    echo "Grade: D";
} elseif ($marks >= 0) {
    echo "Grade: Fail";
} else {
    echo "Invalid marks entered.";
}
?>
