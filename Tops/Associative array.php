<?php
$person = [

    "name"=>"ajay",
    "age"=>"30",
    "email"=>"ajrajput008@gmail.com"
];

 /*echo $person["name"];
 echo "</br>";
 echo $person["age"];
 echo "</br>";
 echo $person ["email"];
 echo"</br>";*/


  foreach ($person as $key=> $x){
     echo $key."is ".$x;
  }
?>

