<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method=""post>

    <input type = "submit" value="Transfer here" name="asubmit">
    </form>
</body>
</html>

<?php
if(isset($_REQUEST['asubmit'])){
    header("Location:date and time1.php");
}
?>