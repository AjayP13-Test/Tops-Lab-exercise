<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <input type = "submit" value = "Click here" name = "asubmit">
    </form>
</body>
</html>

<?php
if(isset($_REQUEST['asubmit'])){
    header("Location:Login.php");
}

    //if(submit==true){
      //  echo "Logged";
   // }else{
      //  echo "Logged not";
    //}
//}
?>