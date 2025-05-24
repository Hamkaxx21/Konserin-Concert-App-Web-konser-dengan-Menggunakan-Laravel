@props(['booking'])

<div class="card shadow-sm mb-3 border-0">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
        <div class="mb-2 mb-md-0">
            <h5 class="card-title mb-1">{{ $booking->event->title }}</h5>
            <p class="mb-1 text-muted">Date: {{ \Carbon\Carbon::parse($booking->event->date)->format('F j, Y') }}</p>
            <p class="mb-1 text-muted">Venue: {{ $booking->event->venue }}</p>
            <p class="mb-1 text-muted">Booking No: <strong>{{ $booking->booking_number }}</strong></p>
        </div>
        <div>
            <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : 'bg-danger' }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
    </div>
</div>
