@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <section class="section">
        <div class="container">
            <div class="event-detail">
                <div class="event-detail-main">
                    <div class="event-detail-image">
                        <img src="https://i.pinimg.com/736x/88/bd/94/88bd94c3ba89bcf1f751a42521847461.jpg" alt="{{ $event->title }}">
                    </div>
                    
                    <div class="event-detail-info">
                        <h1 class="event-detail-title">{{ $event->title }}</h1>
                        
                        <div class="event-detail-meta">
                            <div class="event-meta-item">
                                <span class="event-meta-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </span>
                                <span>{{ $event->venue }}, {{ $event->location }}</span>
                            </div>
                            
                            <div class="event-meta-item">
                                <span class="event-meta-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </span>
                                <span>Organized by {{ $event->organizer }}</span>
                            </div>
                        </div>
                        
                        <div class="event-description">
                            <h3>Event Description</h3>
                            <p>{{ $event->description }}</p>
                        </div>
                        
                        @if($event->artists->count() > 0)
                            <div class="event-artists">
                                <h3>Performing Artists</h3>
                                <div class="artist-list">
                                    @foreach($event->artists as $artist)
                                        <div class="artist-item">
                                            <img src="https://i.pinimg.com/736x/88/bd/94/88bd94c3ba89bcf1f751a42521847461.jpg" alt="{{ $artist->name }}" class="artist-avatar">
                                            <span class="artist-name">{{ $artist->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="event-location">
                            <h3>Location</h3>
                            <p>{{ $event->venue }}, {{ $event->location }}</p>
                            <div class="location-map">
                                <!-- Map placeholder -->
                                <div class="map-placeholder">
                                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7387.107805560284!2d110.3922525979466!3d-7.05059781005457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b3a1e3a1529%3A0x4cda1f81771c5e97!2sUniversitas%20Negeri%20Semarang%20(UNNES)!5e0!3m2!1sid!2sid!4v1746604033316!5m2!1sid!2sid" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Events -->
                    @if($relatedEvents->count() > 0)
                        <div class="related-events">
                            <h3>Related Events</h3>
                            <div class="event-grid">
                                @foreach($relatedEvents as $relatedEvent)
                                    <div class="event-card">
                                        <div style="position: relative;">
                                            <img src="{{ asset('images/concert.jpg') }}" alt="{{ $relatedEvent->title }}" class="event-image">
                                            <div class="event-date">
                                                <span>{{ $relatedEvent->day }}</span>
                                                <span>{{ $relatedEvent->month }}</span>
                                            </div>
                                        </div>
                                        <div class="event-content">
                                            <h3 class="event-title">{{ $relatedEvent->title }}</h3>
                                            <p class="event-location">{{ $relatedEvent->venue }}, {{ $relatedEvent->location }}</p>
                                            <p class="event-price">Mulai dari Rp {{ number_format($relatedEvent->lowest_price, 0, ',', '.') }}</p>
                                            <div class="event-actions">
                                                <a href="{{ route('events.show', $relatedEvent->slug) }}" class="btn btn-outline">Detail</a>
                                                <a href="{{ route('bookings.create', $relatedEvent->slug) }}" class="btn btn-primary">Pesan Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="event-sidebar">
                    <h3>Tickets</h3>
                    <p>Secure your spot at this amazing event!</p>
                    
                    <form action="{{ route('bookings.add-to-cart', $event->slug) }}" method="POST" class="ticket-form">
                        @csrf
                        <div class="event-tickets">
                            @foreach($event->tickets as $index => $ticket)
                                <div class="ticket-option">
                                    <div class="ticket-name">{{ $ticket->name }}</div>
                                    <div class="ticket-price">{{ $ticket->formatted_price }}</div>
                                    <div class="ticket-description">{{ $ticket->description }}</div>
                                    <div class="ticket-quantity">
                                        <span>Quantity:</span>
                                        <select name="tickets[{{ $index }}][quantity]" class="form-select">
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
                        
                        <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                    </form>
                    
                    <div class="event-share mt-lg">
                        <h4>Share This Event</h4>
                        <div class="share-buttons">
                            <a href="#" class="share-btn">
                                <img src="{{ asset('images/facebook-logo.png') }}" alt="Facebook" style="width: 24px; height: 24px;">
                            </a>
                            <a href="#" class="share-btn">
                                <img src="{{ asset('images/twitter-logo.png') }}" alt="Twitter" style="width: 24px; height: 24px;">
                            </a>
                            <a href="#" class="share-btn">
                                <img src="{{ asset('images/wa-logo.png') }}" alt="WhatsApp" style="width: 24px; height: 24px;">
                            </a>
                            <a href="#" class="share-btn">
                                <img src="{{ asset('images/instagram-logo.png') }}" alt="Telegram" style="width: 24px; height: 24px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .artist-list {
        display: flex;
        flex-wrap: wrap;
        gap: var(--spacing-md);
        margin-top: var(--spacing-md);
    }
    
    .artist-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .artist-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: var(--spacing-sm);
    }
    
    .artist-name {
        font-weight: 500;
    }
    
    .map-placeholder {
        width: 100%;
        height: 300px;
        background-color: #eee;
        margin-top: var(--spacing-md);
        border-radius: var(--radius-md);
        overflow: hidden;
    }
    
    .map-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .related-events {
        margin-top: var(--spacing-xxl);
    }
    
    .related-events h3 {
        margin-bottom: var(--spacing-lg);
    }
    
    .share-buttons {
        display: flex;
        gap: var(--spacing-sm);
        margin-top: var(--spacing-sm);
    }
    
    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .share-btn:hover {
        background-color: var(--primary-color);
        color: var(--text-white);
    }
</style>
@endsection