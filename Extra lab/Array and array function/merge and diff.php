<?php
$array1 = [1, 2, 3, 4, 5];
$array2 = [4, 5, 6, 7, 8];

// Merge the two arrays
$mergedArray = array_merge($array1, $array2);

// Find elements in $mergedArray that are not in $array1 (difference)
$difference = array_diff($mergedArray, $array1);

echo "Merged Array: ";
print_r($mergedArray);

echo "<br>Difference (elements in merged array not in array1): ";
print_r($difference);
?>
