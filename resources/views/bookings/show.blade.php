@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-20">
    <h1 class="text-2xl font-bold mb-6">Booking Details</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Booking Number: {{ $booking->booking_number }}</h2>
        <p class="mb-2"><strong>Event:</strong> {{ $booking->event->title }}</p>
        <p class="mb-2"><strong>Booking Date:</strong> {{ $booking->created_at->format('d M Y') }}</p>
        <p class="mb-2"><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</p>
        <p class="mb-2"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</p>
        <p class="mb-4"><strong>Total Amount:</strong> Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>

        <h3 class="text-lg font-semibold mb-3">Tickets</h3>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Ticket Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking->bookingItems as $item)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->ticket->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <a href="{{ route('bookings') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Back to My Bookings</a>
        </div>
    </div>
</div>
@endsection
