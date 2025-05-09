@extends('layouts.app')

@section('title', 'Book Tickets - ' . $event->title)

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="section-title">Book Tickets</h1>
            <p class="section-subtitle">Secure your spot at {{ $event->title }}</p>
            
            <div class="booking-container">
                <div class="booking-event-details">
                    <div class="event-image-container">
                        <img src="{{ asset('images/concert.jpg') }}" alt="{{ $event->title }}" class="event-image">
                    </div>
                    
                    <div class="event-info">
                        <h2>{{ $event->title }}</h2>
                        
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <span class="event-meta-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </span>
                                <span>{{ $event->formatted_date }} • {{ $event->time }}</span>
                            </div>
                            
                            <div class="event-meta-item">
                                <span class="event-meta-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </span>
                                <span>{{ $event->venue }}, {{ $event->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="booking-form-container">
                    @if (session('error'))
                        <div class="alert alert-error">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('bookings.add-to-cart', $event->slug) }}" method="POST" class="booking-form">
                        @csrf
                        <h3>Select Tickets</h3>
                        
                        <div class="ticket-options">
                            @foreach($event->tickets as $index => $ticket)
                                <div class="ticket-option">
                                    <div class="ticket-info">
                                        <h4>{{ $ticket->name }}</h4>
                                        <p class="ticket-description">{{ $ticket->description }}</p>
                                        <p class="ticket-price">{{ $ticket->formatted_price }}</p>
                                        <p class="ticket-availability">{{ $ticket->available }} tickets left</p>
                                    </div>
                                    
                                    <div class="ticket-quantity">
                                        <label for="ticket-{{ $ticket->id }}">Quantity:</label>
                                        <select name="tickets[{{ $index }}][quantity]" id="ticket-{{ $ticket->id }}" class="form-select ticket-quantity-select">
                                            <option value="0">0</option>
                                            @for($i = 1; $i <= min(10, $ticket->available); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="tickets[{{ $index }}][id]" value="{{ $ticket->id }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="booking-summary">
                            <h3>Summary</h3>
                            <div class="summary-items" id="summary-items">
                                <p class="empty-cart">No tickets selected</p>
                            </div>
                            
                            <div class="summary-total">
                                <span>Total:</span>
                                <span id="total-amount">Rp 0</span>
                            </div>
                        </div>
                        
                        <div class="booking-actions">
                            <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .booking-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--spacing-xl);
        margin-top: var(--spacing-xl);
    }
    
    .booking-event-details {
        background-color: var(--bg-white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .event-image-container {
        height: 300px;
        overflow: hidden;
    }
    
    .event-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .event-info {
        padding: var(--spacing-lg);
    }
    
    .event-meta {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-sm);
        margin-top: var(--spacing-md);
    }
    
    .event-meta-item {
        display: flex;
        align-items: center;
    }
    
    .event-meta-icon {
        margin-right: var(--spacing-sm);
        color: var(--primary-color);
    }
    
    .booking-form-container {
        background-color: var(--bg-white);
        border-radius: var(--radius-lg);
        padding: var(--spacing-lg);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .ticket-options {
        margin-top: var(--spacing-lg);
        display: flex;
        flex-direction: column;
        gap: var(--spacing-md);
    }
    
    .ticket-option {
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: var(--spacing-md);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .ticket-info h4 {
        margin-bottom: var(--spacing-xs);
    }
    
    .ticket-description {
        color: var(--text-light);
        font-size: var(--font-sm);
        margin-bottom: var(--spacing-xs);
    }
    
    .ticket-price {
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: var(--spacing-xs);
    }
    
    .ticket-availability {
        font-size: var(--font-sm);
        color: var(--text-light);
    }
    
    .ticket-quantity {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: var(--spacing-xs);
    }
    
    .ticket-quantity-select {
        width: 80px;
    }
    
    .booking-summary {
        margin-top: var(--spacing-xl);
        border-top: 1px solid var(--border-color);
        padding-top: var(--spacing-lg);
    }
    
    .summary-items {
        margin-top: var(--spacing-md);
        margin-bottom: var(--spacing-lg);
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: var(--spacing-sm);
    }
    
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: var(--font-md);
        border-top: 1px solid var(--border-color);
        padding-top: var(--spacing-md);
    }
    
    .booking-actions {
        margin-top: var(--spacing-xl);
    }
    
    .empty-cart {
        text-align: center;
        color: var(--text-light);
        font-style: italic;
    }
    
    @media (max-width: 992px) {
        .booking-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ticketSelects = document.querySelectorAll('.ticket-quantity-select');
        const summaryItems = document.getElementById('summary-items');
        const totalAmount = document.getElementById('total-amount');
        
        function updateSummary() {
            let hasItems = false;
            let total = 0;
            let summaryHTML = '';
            
            ticketSelects.forEach((select, index) => {
                const quantity = parseInt(select.value);
                if (quantity > 0) {
                    hasItems = true;
                    const ticketOption = select.closest('.ticket-option');
                    const ticketName = ticketOption.querySelector('h4').textContent;
                    const ticketPrice = ticketOption.querySelector('.ticket-price').textContent;
                    const priceValue = parseInt(ticketPrice.replace(/[^0-9]/g, ''));
                    const subtotal = quantity * priceValue;
                    
                    summaryHTML += `
                        <div class="summary-item">
                            <span>${quantity}x ${ticketName}</span>
                            <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                        </div>
                    `;
                    
                    total += subtotal;
                }
            });
            
            if (hasItems) {
                summaryItems.innerHTML = summaryHTML;
                totalAmount.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            } else {
                summaryItems.innerHTML = '<p class="empty-cart">No tickets selected</p>';
                totalAmount.textContent = 'Rp 0';
            }
        }
        
        ticketSelects.forEach(select => {
            select.addEventListener('change', updateSummary);
        });
    });
</script>
@endsection