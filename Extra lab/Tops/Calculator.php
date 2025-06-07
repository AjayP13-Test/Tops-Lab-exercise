<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Calculator</title>
</head>
<body>
    <h2>PHP Calculator</h2>
    <form method="post">
        <input type="number" name="num1" placeholder="Enter first number" required>
        <input type="number" name="num2" placeholder="Enter second number" required>
        <select name="operator">
            <option value="+">Add (+)</option>
            <option value="-">Subtract (-)</option>
            <option value="*">Multiply (*)</option>
            <option value="/">Divide (/)</option>
        </select>
        <input type="submit" name="calculate" value="Calculate">
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
   

        if ($operator == "+") {
            $result = $num1 + $num2;
        } elseif ($operator == "-") {
            $result = $num1 - $num2;
        } elseif ($operator == "*") {
            $result = $num1 * $num2;
        } elseif ($operator == "/") {
            if ($num2 == 0) {
                $result = "Cannot divide by zero.";
            } else {
                $result = $num1 / $num2;
            }
        } else {
            $result = "Invalid operator.";
        }

        echo "<h3>Result: $result</h3>";
    }
    ?>
</body>
</html>
