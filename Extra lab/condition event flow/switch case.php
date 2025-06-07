<?php

$grade = 'B';

switch ($grade) {
    case 'A':
    
        echo "Excellent!";
        break;

    case 'B':
        echo "Good.";
        break;

    case 'C':
        echo "Needs Improvement.";
        break;

    case 'D':
        echo "Failing grade.";
        break;

    default:
        echo "Invalid grade entered.";
}
?>
