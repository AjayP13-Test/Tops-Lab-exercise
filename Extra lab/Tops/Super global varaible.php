<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>

    <fieldset>
        <form method="post" >
        <label for="">Username</label>
        <input type="text" placeholder = "Enter your name" name="uname" id="">
         <br><br>
        <label for="">Email</label>
        <input type="text" placeholder = "Enter your email" name="email" id="">
         <br><br>
         <label for="">Mobile number</label>
         <input type="text" placeholder = "Enter your mobile number "name="Mobile" id="" required>
         <br><br>
         <label for="">Pincode</label>
         <input type="text" placeholder = "Enter your pincode" name="pincode" id="">
         <br><br>

         

         <input type="submit" value="submit" name="submit">
         </form>
    </fieldset>
</body>

</html>
<?php
    if(isset($_POST['submit'])){
        echo $username = $_POST['uname'];
        echo "<br>";
        echo $email = $_POST['email'];
        echo "<br>";
        echo $Mobilenumber = $_POST['Mobile'];
        echo "<br>";
        echo $Pincode = $_POST['pincode'];
    }


?>