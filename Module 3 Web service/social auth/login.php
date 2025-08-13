<?php
require 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId("YOUR_GOOGLE_CLIENT_ID");
$client->setClientSecret("YOUR_GOOGLE_CLIENT_SECRET");
$client->setRedirectUri("http://localhost/google-callback.php");
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Social Login</title>
</head>
<body>
    <a href="<?= htmlspecialchars($login_url) ?>">
        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Login with Google">
    </a>
</body>
</html>
