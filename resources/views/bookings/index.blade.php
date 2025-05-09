@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
    <section class="section">
        <div class="container">
            <h1>My Bookings</h1>

            @if($bookings->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Event</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Booking Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_number }}</td>
                                <td>{{ $booking->event->title }}</td>
                                <td>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($booking->payment_status) }}</td>
                                <td>{{ $booking->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking->booking_number) }}" class="btn btn-primary btn-sm">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $bookings->links() }}
            @else
                <p>You have no bookings yet.</p>
            @endif
        </div>
    </section>
@endsection
