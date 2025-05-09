@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="section-title">Your Cart</h1>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(count($cart) > 0)
                <div class="cart-items">
                    <div class="cart-header cart-item">
                        <div>Event & Ticket</div>
                        <div>Price</div>
                        <div>Quantity</div>
                        <div>Subtotal</div>
                        <div></div>
                    </div>
                    
                    @foreach($cart as $index => $item)
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <h4>{{ $item['event_title'] }}</h4>
                                <p>{{ $item['ticket_name'] }}</p>
                                <p>{{ $item['event_date'] }}</p>
                            </div>
                            <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            <div class="cart-item-quantity">{{ $item['quantity'] }}</div>
                            <div class="cart-item-subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                            <div class="cart-item-actions">
                                <form action="{{ route('cart.remove', $index) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="cart-footer">
                    <div class="cart-total">
                        <div class="cart-total-row">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="cart-total-row">
                            <span>Service Fee</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="cart-total-row total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="cart-actions">
                        <a href="{{ route('events.index') }}" class="btn btn-outline">Continue Shopping</a>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                </div>
            @else
                <div class="empty-cart-container">
                    <div class="empty-cart-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <h2>Your cart is empty</h2>
                        <p>Looks like you haven't added any tickets to your cart yet.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary">Browse Events</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('styles')
<style>
    .cart-header {
        font-weight: 600;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: var(--spacing-md);
    }
    
    .cart-header div {
        font-size: var(--font-sm);
        color: var(--text-light);
    }
    
    .cart-actions {
        display: flex;
        justify-content: space-between;
        margin-top: var(--spacing-lg);
    }
    
    .empty-cart-container {
        padding: var(--spacing-xxl) 0;
        text-align: center;
    }
    
    .empty-cart-message {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .empty-cart-message svg {
        color: var(--text-light);
        margin-bottom: var(--spacing-lg);
    }
    
    .empty-cart-message h2 {
        margin-bottom: var(--spacing-md);
    }
    
    .empty-cart-message p {
        color: var(--text-light);
        margin-bottom: var(--spacing-lg);
    }
</style>
@endsection