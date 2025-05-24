@extends('layouts.app')

@section('title', 'Booking Success')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success text-center">
                <h4 class="fw-bold">🎉 Booking Successful!</h4>
                <p>Your booking has been confirmed. Details are shown below.</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Booking Number: <strong>{{ $booking->booking_number }}</strong></h5>
                </div>

                <div class="card-body">
                    <h5 class="fw-bold">{{ $booking->event->title }}</h5>
                    <p><i class="bi bi-calendar-event"></i> {{ $booking->event->formatted_date }}</p>

                    <hr>

                    <h6 class="fw-bold">Tickets:</h6>
                    <ul class="list-group mb-3">
                        @foreach ($booking->bookingItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->ticket->name }} (x{{ $item->quantity }})
                                <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <h6>Total Amount: <strong>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</strong></h6>
                    <p class="mb-0">Payment Method: <strong>{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</strong></p>
                    <p>Status: <span class="badge bg-success">{{ ucfirst($booking->status ?? 'confirmed') }}</span></p>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('bookings') }}" class="btn btn-outline-primary">View My Bookings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
    });
</script>
@endsection
