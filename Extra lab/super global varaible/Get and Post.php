<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get">
        <input type = "text" placeholder = "enter name " name = "name">
       <br>
       <br>
         <input type = "text" placeholder = "enter email" name = "email">
         <br>
         <br>

         <input type = "submit" value = "submit" name = "psubmit">


    </form>
</body>
</html>

<?php
if(isset($_GET['psubmit'])){
    $name = $_GET['name'];
    $email =$_GET['email'];
}
?>