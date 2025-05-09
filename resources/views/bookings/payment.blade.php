@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="section-title">Complete Payment</h1>

        <div class="payment-container">
            <div id="card-element"><!--Stripe.js injects the Card Element--></div>
            <button id="submit" class="btn btn-primary mt-3">Pay Now</button>
            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
        </div>

        <div class="order-summary mt-5">
            <h3>Order Summary</h3>
            @foreach($cart as $item)
                <div class="order-item">
                    <h4>{{ $item['event_title'] }}</h4>
                    <p>{{ $item['ticket_name'] }} x {{ $item['quantity'] }}</p>
                    <p>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                </div>
            @endforeach
            <div class="order-total">
                <strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const submitButton = document.getElementById('submit');
    const cardErrors = document.getElementById('card-errors');

    submitButton.addEventListener('click', async (e) => {
        e.preventDefault();
        submitButton.disabled = true;

        const { paymentIntent, error } = await stripe.confirmCardPayment('{{ $clientSecret }}', {
            payment_method: {
                card: card,
            }
        });

        if (error) {
            cardErrors.textContent = error.message;
            submitButton.disabled = false;
        } else if (paymentIntent.status === 'succeeded') {
            // Payment succeeded, redirect to success page
            window.location.href = "{{ route('bookings.success') }}";
        }
    });
</script>
@endsection
