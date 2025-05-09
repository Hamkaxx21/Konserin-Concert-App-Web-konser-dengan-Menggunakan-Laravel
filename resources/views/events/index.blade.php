@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="section-title">Explore Events</h1>
            
            <!-- Search Form -->
            <div class="search-section">
                <form action="{{ route('events.index') }}" method="GET" class="search-form">
                    <div class="form-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search Event" aria-label="Search Event">
                    </div>
                    <div class="form-group">
                        <select name="location" class="form-select" aria-label="Location">
                            <option value="">All Locations</option>
                            <option value="Jakarta" {{ request('location') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="Bandung" {{ request('location') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="Surabaya" {{ request('location') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="Bali" {{ request('location') == 'Bali' ? 'selected' : '' }}>Bali</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="date" class="form-select" aria-label="Date">
                            <option value="">Any date</option>
                            <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="tomorrow" {{ request('date') == 'tomorrow' ? 'selected' : '' }}>Tomorrow</option>
                            <option value="this-week" {{ request('date') == 'this-week' ? 'selected' : '' }}>This Week</option>
                            <option value="this-month" {{ request('date') == 'this-month' ? 'selected' : '' }}>This Month</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-section mb-xl">
                <div class="filter-categories">
                    <span>Categories:</span>
                    <a href="{{ route('events.index') }}" class="{{ !request('category') ? 'active' : '' }}">All</a>
                    @foreach($categories as $category)
                        <a href="{{ route('events.index', ['category' => $category->id]) }}" class="{{ request('category') == $category->id ? 'active' : '' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
            
            <!-- Events Grid -->
            <div class="event-grid">
                @forelse($events as $event)
                    <div class="event-card">
                        <div style="position: relative;">
                            <img src="https://i.pinimg.com/736x/f3/b2/3b/f3b23b82a1a536807aab03334ea61b75.jpg" alt="{{ $event->title }}" class="event-image">
                            <div class="event-date">
                                <span>{{ $event->day }}</span>
                                <span>{{ $event->month }}</span>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">{{ $event->title }}</h3>
                            <p class="event-location">{{ $event->venue }}, {{ $event->location }}</p>
                            <p class="event-price">Mulai dari Rp {{ number_format($event->lowest_price, 0, ',', '.') }}</p>
                            <div class="event-actions">
                                <a href="{{ route('events.show', $event->slug) }}" class="btn btn-outline">Detail</a>
                                <a href="{{ route('bookings.create', $event->slug) }}" class="btn btn-primary">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-events">
                        <p>No events found matching your criteria.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="pagination-container">
                {{ $events->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .filter-section {
        margin-top: var(--spacing-lg);
    }
    
    .filter-categories {
        display: flex;
        flex-wrap: wrap;
        gap: var(--spacing-sm);
        align-items: center;
    }
    
    .filter-categories span {
        font-weight: 600;
        margin-right: var(--spacing-sm);
    }
    
    .filter-categories a {
        padding: var(--spacing-xs) var(--spacing-sm);
        border-radius: var(--radius-sm);
        background-color: var(--bg-white);
        transition: all 0.3s ease;
    }
    
    .filter-categories a.active,
    .filter-categories a:hover {
        background-color: var(--primary-color);
        color: var(--text-white);
    }
    
    .no-events {
        grid-column: 1 / -1;
        text-align: center;
        padding: var(--spacing-xl);
    }
</style>
@endsection