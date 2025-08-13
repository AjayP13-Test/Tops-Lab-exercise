<?php
require 'vendor/autoload.php'; // For Composer

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Save user in DB (example without validation)
    $conn = new mysqli("localhost", "root", "", "testdb");
    $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");

    // Send Email via SendGrid
    $apiKey = "YOUR_SENDGRID_API_KEY";
    $emailObj = new \SendGrid\Mail\Mail(); 
    $emailObj->setFrom("noreply@yourdomain.com", "Your App");
    $emailObj->setSubject("Welcome to Our App, $name!");
    $emailObj->addTo($email, $name);
    $emailObj->addContent(
        "text/html", 
        "<h3>Hello $name,</h3>
         <p>Thanks for registering at our site. We’re excited to have you on board! 🎉</p>"
    );

    $sendgrid = new \SendGrid($apiKey);
    try {
        $response = $sendgrid->send($emailObj);
        echo "Registration successful. Confirmation email sent!";
    } catch (Exception $e) {
        echo 'Email failed: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
<h2>Register</h2>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>
</body>
</html>
