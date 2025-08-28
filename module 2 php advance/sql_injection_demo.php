<?php
$conn = new mysqli("localhost", "root", "", "test");
$user = $_GET['user'];
$pass = $_GET['pass'];
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);
echo "Query: " . $sql;
?>
