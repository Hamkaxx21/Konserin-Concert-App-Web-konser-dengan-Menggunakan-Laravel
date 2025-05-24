@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="section-title">Checkout</h1>
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="checkout-section">
                <div class="checkout-form-container">
                    <form action="{{ route('checkout.process') }}" method="POST" class="checkout-form">
                        @csrf
                        
                        <div class="checkout-user-info">
                            <h3>Your Information</h3>
                            <div class="user-info-display">
                                <div class="user-info-row">
                                    <strong>Name:</strong>
                                    <span>{{ auth()->user()->name }}</span>
                                </div>
                                <div class="user-info-row">
                                    <strong>Email:</strong>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <div class="user-info-row">
                                    <strong>Phone:</strong>
                                    <span>{{ auth()->user()->phone ?? 'Not provided' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="payment-section">
                            <h3>Payment Method</h3>
                            <div class="payment-methods">
                                <div class="payment-method">
                                    <div class="payment-method-header">
                                        <input type="radio" id="credit_card" name="payment_method" value="credit_card" class="payment-method-radio" required checked>
                                        <label for="credit_card" class="payment-method-name">Credit Card</label>
                                    </div>
                                    <div class="payment-method-content">
                                        <p>Pay securely using your credit card.</p>
                                        <div class="payment-icons">
                                            <img src="{{ asset('images/visa-logo.png') }}" alt="Visa" class="payment-icon" style="height: 24px;">
                                            <img src="{{ asset('images/Mastercard-logo.png') }}" alt="Mastercard" class="payment-icon" style="height: 24px;">
                                            <img src="{{ asset('images/Americanexpress-Logo.png') }}" alt="American Express" class="payment-icon" style="height: 24px;">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="payment-method">
                                    <div class="payment-method-header">
                                        <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="payment-method-radio" required>
                                        <label for="bank_transfer" class="payment-method-name">Bank Transfer</label>
                                    </div>
                                    <div class="payment-method-content">
                                        <p>Transfer the exact amount to our bank account. Confirmation within 24 hours after payment is received.</p>
                                    </div>
                                </div>
                                
                                <div class="payment-method">
                                    <div class="payment-method-header">
                                        <input type="radio" id="e_wallet" name="payment_method" value="e_wallet" class="payment-method-radio" required>
                                        <label for="e_wallet" class="payment-method-name">E-Wallet</label>
                                    </div>
                                    <div class="payment-method-content">
                                        <p>Pay with your e-wallet for instant confirmation.</p>
                                        <div class="payment-icons">
                                            <img src="{{ asset('images/gopay-logo.png') }}" alt="GoPay" class="payment-icon" style="height: 24px;">
                                            <img src="{{ asset('images/OVO-logo.png') }}" alt="OVO" class="payment-icon" style="height: 24px;">
                                            <img src="{{ asset('images/dana-logo.png') }}" alt="DANA" class="payment-icon" style="height: 24px;">
                                            <img src="{{ asset('images/linkaja-logopng.png') }}" alt="LinkAja" class="payment-icon" style="height: 24px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="checkout-terms">
                            <div class="form-check">
                                <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                                <label for="terms" class="form-check-label">
                                    I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                                </label>
                            </div>
                        </div>
                        
                        <div class="checkout-actions">
                            <a href="{{ route('cart') }}" class="btn btn-outline">Back to Cart</a>
                            <button type="submit" class="btn btn-primary">Complete Purchase</button>
                        </div>
                    </form>
                </div>
                
                <div class="checkout-summary">
                    <h3>Order Summary</h3>
                    
                    <div class="order-items">
                        @foreach($cart as $item)
                            <div class="order-item">
                                <div class="order-item-details">
                                    <h4>{{ $item['event_title'] }}</h4>
                                    <p>{{ $item['ticket_name'] }} x {{ $item['quantity'] }}</p>
                                    <p class="order-item-date">{{ $item['event_date'] }}</p>
                                </div>
                                <div class="order-item-price">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="order-totals">
                        <div class="order-total-row">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="order-total-row">
                            <span>Service Fee</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="order-total-row total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .checkout-form-container {
        background-color: var(--bg-white);
        border-radius: var(--radius-lg);
        padding: var(--spacing-lg);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .checkout-user-info {
        margin-bottom: var(--spacing-xl);
    }
    
    .user-info-display {
        margin-top: var(--spacing-md);
        padding: var(--spacing-md);
        background-color: var(--bg-light);
        border-radius: var(--radius-md);
    }
    
    .user-info-row {
        display: flex;
        justify-content: space-between;
        padding: var(--spacing-sm) 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .user-info-row:last-child {
        border-bottom: none;
    }
    
    .payment-section {
        margin-bottom: var(--spacing-xl);
    }
    
    .payment-methods {
        margin-top: var(--spacing-md);
    }
    
    .payment-method {
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: var(--spacing-md);
        margin-bottom: var(--spacing-sm);
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    
    .payment-method:hover {
        border-color: var(--primary-color);
    }
    
    .payment-method-header {
        display: flex;
        align-items: center;
        margin-bottom: var(--spacing-sm);
    }
    
    .payment-method-radio {
        margin-right: var(--spacing-sm);
    }
    
    .payment-method-name {
        font-weight: 600;
    }
    
    .payment-method-content {
        padding-left: calc(var(--spacing-md) + 16px);
    }
    
    .payment-method-content p {
        color: var(--text-light);
        margin-bottom: var(--spacing-sm);
    }
    
    .payment-icons {
        display: flex;
        gap: var(--spacing-sm);
        flex-wrap: wrap;
    }
    
    .payment-icon {
        padding: var(--spacing-xs) var(--spacing-sm);
        background-color: var(--bg-light);
        border-radius: var(--radius-sm);
        font-size: var(--font-sm);
    }
    
    .checkout-terms {
        margin-bottom: var(--spacing-xl);
    }
    
    .form-check {
        display: flex;
        align-items: flex-start;
    }
    
    .form-check-input {
        margin-right: var(--spacing-sm);
        margin-top: 4px;
    }
    
    .checkout-actions {
        display: flex;
        justify-content: space-between;
    }
    
    .checkout-summary {
        background-color: var(--bg-white);
        border-radius: var(--radius-lg);
        padding: var(--spacing-lg);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        align-self: flex-start;
    }
    
    .order-items {
        margin-top: var(--spacing-md);
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: var(--spacing-md) 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .order-item-details h4 {
        margin-bottom: var(--spacing-xs);
    }
    
    .order-item-details p {
        color: var(--text-light);
        font-size: var(--font-sm);
        margin-bottom: 0;
    }
    
    .order-item-date {
        font-size: var(--font-xs);
    }
    
    .order-item-price {
        font-weight: 600;
    }
    
    .order-totals {
        margin-top: var(--spacing-lg);
        padding-top: var(--spacing-md);
        border-top: 1px solid var(--border-color);
    }
    
    .order-total-row {
        display: flex;
        justify-content: space-between;
        padding: var(--spacing-sm) 0;
    }
    
    .order-total-row.total {
        font-weight: 700;
        font-size: var(--font-md);
        border-top: 1px solid var(--border-color);
        padding-top: var(--spacing-md);
        margin-top: var(--spacing-sm);
    }
    
    @media (max-width: 992px) {
        .checkout-section {
            grid-template-columns: 1fr;
        }
        
        .checkout-summary {
            margin-top: var(--spacing-lg);
        }

        .payment-method.active {
        border-color: var(--primary-color);
        background-color: var(--bg-light);
        }

        .payment-method.active .payment-method-name {
            color: var(--primary-color);
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('.payment-method');

        paymentMethods.forEach(method => {
            const radio = method.querySelector('input[type="radio"]');

            method.addEventListener('click', function () {
                radio.checked = true;
                paymentMethods.forEach(m => m.classList.remove('active'));
                method.classList.add('active');
            });

            if (radio.checked) {
                method.classList.add('active');
            }
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745',
                scrollbarPadding: false
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Booking in Progress',
                text: '{{ session('info') }}',
                confirmButtonColor: '#6c5ce7',
                scrollbarPadding: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                scrollbarPadding: false
            });
        @endif
    });
</script>
@endsection



