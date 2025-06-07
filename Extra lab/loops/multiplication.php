<?php
echo "<table border='1' cellpadding='5' cellspacing='0'>";

for ($row = 1; $row <= 10; $row++) {
    echo "<tr>";
    for ($col = 1; $col <= 10; $col++) {
        $product = $row * $col;
        echo "<td>$product</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>
