<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form>
    <input type = "submit" value = "Download here" name = "lsubmit">
</form>    
</body>
</html>
<?php
if(isset($_REQUEST ['lsubmit'])){

    header("Content-type:application/pdf");

    header("Content-Disposition:attachment;filename:'resume.pdf'");

    readfile("AJAY VOTER.pdf");


}

?>