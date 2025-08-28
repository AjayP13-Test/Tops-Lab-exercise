<?php
session_start();
$_SESSION['username'] = "Ajay";
setcookie("token", "12345", time()+3600);

echo "Session username: " . $_SESSION['username'];
echo "<br>Cookie token: " . $_COOKIE['token'];
?>
