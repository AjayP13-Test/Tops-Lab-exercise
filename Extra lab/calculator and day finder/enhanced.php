<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "post">
        <lable for = ""> Number1 </lable>
        <input type ="text" name = "n1" id="">

        <label for ="">Number 2</label>
        <input type = "text" name = "n2" id="">

        <label for = "">Operator</label>
        <input type ="text" name ="op" id="">

         <input type="submit" value="Check" name="calc">

    </form>
</body>
</html>
<?php
if(isset($_REQUEST['calc'])){
    $n1=$_REQUEST ['n1'];
    $n2=$_REQUEST ['n2'];
    $op=$_REQUEST ['op'];

    switch($op){
        case  '+':
          echo "addition = ". $n1+$n2;
          break;

         case '-':
         echo "subtraction = ". $n1-$n2;
         break;

         case '*':
         echo "multiplacation = ".$n1*$n2;
         break;

         case '/':
         echo "division = ".$n1/$n2;
         break;

          case '%':
         echo "modulus = ".$n1/$n2;
         break;

          case '^':
         echo "exponentiation = ".$n1/$n2;
         break;

         case '√':
         echo "squareroot = ".$n1/$n2;
         break;


         default:
         echo "invalid choice";
         break;
    }
}
?>