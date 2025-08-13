<?php
require 'vendor/autoload.php';  // Composer autoload

\Stripe\Stripe::setApiKey('sk_test_your_secret_key'); // Replace with your secret key

// Read JSON body
$input = json_decode(file_get_contents('php://input'), true);

$paymentMethodId = $input['payment_method_id'] ?? null;
$amount = $input['amount'] ?? null; // amount in cents

if (!$paymentMethodId || !$amount) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payment data']);
    exit;
}

try {
    // Create PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd',
        'payment_method' => $paymentMethodId,
        'confirmation_method' => 'manual',
        'confirm' => true,
    ]);

    if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
        // Card requires authentication (3D Secure)
        echo json_encode([
            'requires_action' => true,
            'payment_intent_client_secret' => $paymentIntent->client_secret,
        ]);
    } elseif ($paymentIntent->status === 'succeeded') {
        // Payment successful
        echo json_encode(['success' => true]);
    } else {
        // Other failure
        http_response_code(400);
        echo json_encode(['error' => 'Payment failed']);
    }
} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
