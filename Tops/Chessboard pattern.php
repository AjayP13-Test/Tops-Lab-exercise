<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            width: 50px;
            height: 50px;
        }
        .white {
            background-color: #fff;
        }
        .black {
            background-color: #000;
        }
    </style>
</head>
<body>

<table border="1">
    <?php
    for ($row = 0; $row < 8; $row++) {
        echo "<tr>";
        for ($col = 0; $col < 8; $col++) {
            // Alternate colors using row + col sum
            $color = ($row + $col) % 2 == 0 ? "white" : "black";
            echo "<td class='$color'></td>";
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
