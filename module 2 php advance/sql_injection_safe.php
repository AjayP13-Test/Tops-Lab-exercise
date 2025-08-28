<?php
$conn = new mysqli("localhost", "root", "", "test");
$user = $_GET['user'];
$pass = $_GET['pass'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();
echo "Safe query executed";
?>
