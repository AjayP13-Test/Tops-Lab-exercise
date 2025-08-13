<?php
require 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId("YOUR_GOOGLE_CLIENT_ID");
$client->setClientSecret("YOUR_GOOGLE_CLIENT_SECRET");
$client->setRedirectUri("http://localhost/google-callback.php");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $oauth2 = new Google_Service_Oauth2($client);
        $profile = $oauth2->userinfo->get();

        // Example: Save or login the user in DB
        $conn = new mysqli("localhost", "root", "", "testdb");
        $email = $profile->email;
        $name = $profile->name;

        $result = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($result->num_rows == 0) {
            $conn->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");
        }

        $_SESSION['user'] = $name;
        echo "Welcome, " . $name;
    } else {
        echo "Error fetching token";
    }
}
