<script src="https://js.stripe.com/v3/"></script>

<form id="payment-form">
  <div id="card-element"></div>
  <button type="submit">Pay $10</button>
</form>

<script>
  const stripe = Stripe('pk_test_your_publishable_key'); // Your publishable key
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  const form = document.getElementById('payment-form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const { paymentMethod, error } = await stripe.createPaymentMethod('card', card);

    if (error) {
      alert(error.message);
      return;
    }

    const response = await fetch('pay.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        payment_method_id: paymentMethod.id,
        amount: 1000, // $10 in cents
      }),
    });

    const result = await response.json();

    if (result.error) {
      alert('Payment failed: ' + result.error);
    } else if (result.requires_action) {
      // Handle 3D Secure authentication
      const { error: confirmError } = await stripe.confirmCardPayment(result.payment_intent_client_secret);
      if (confirmError) {
        alert('Authentication failed: ' + confirmError.message);
      } else {
        alert('Payment successful!');
      }
    } else if (result.success) {
      alert('Payment successful!');
    }
  });
</script>
