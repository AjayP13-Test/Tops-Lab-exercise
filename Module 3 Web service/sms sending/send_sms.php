<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Twilio credentials
$account_sid = 'ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$auth_token  = 'your_auth_token';
$twilio_number = '+1234567890'; // Your Twilio phone number

$client = new Client($account_sid, $auth_token);

// Order details
$customer_number = '+919876543210'; // Replace with customer's number
$order_id = 'ORD12345';
$total_amount = 1500;

// Send SMS
$message = $client->messages->create(
    $customer_number, // Destination phone number
    [
        'from' => $twilio_number,
        'body' => "Thank you! Your order #$order_id has been confirmed. Total: ₹$total_amount."
    ]
);

echo "SMS sent! SID: " . $message->sid;
