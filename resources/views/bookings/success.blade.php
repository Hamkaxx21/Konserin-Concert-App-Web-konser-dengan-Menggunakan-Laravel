@extends('layouts.app')

@section('title', 'Booking Success')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="section-title">Booking Successful</h1>
            <p>Thank you for your purchase! Your booking number is <strong>{{ $booking->booking_number }}</strong>.</p>
            <p>We have sent a confirmation email to you.</p>
            <a href="{{ route('events.index') }}" class="btn btn-primary">Back to Events</a>
        </div>
    </section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Payment Successful',
            text: 'Your booking has been completed successfully!',
            confirmButtonText: 'OK'
        });
    });
</script>
@endsection
