<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_YOUR_SECRET_KEY');

$amount = 5000; // amount in cents (₹50.00 or $50.00)

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd', // or 'inr'
            'product_data' => [
                'name' => 'Sample Product',
            ],
            'unit_amount' => $amount,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost/success.php',
    'cancel_url' => 'http://localhost/cancel.php',
]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>Pay $50 for Sample Product</h2>
    <button id="checkoutBtn">Pay Now</button>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_YOUR_PUBLISHABLE_KEY');
        document.getElementById('checkoutBtn').addEventListener('click', function () {
            stripe.redirectToCheckout({ sessionId: "<?= $checkout_session->id ?>" });
        });
    </script>
</body>
</html>
