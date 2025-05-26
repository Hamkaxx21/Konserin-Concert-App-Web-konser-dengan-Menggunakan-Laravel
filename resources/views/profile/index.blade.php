@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold">My Bookings</h2>
        </div>

        {{-- Filter Form --}}
        <div class="col-md-4">
            <form method="GET" action="{{ route('bookings') }}">
                <div class="input-group">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Filter by Status</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Bookings List --}}
    @forelse($bookings as $booking)
        {{-- Komponen Blade untuk satu item booking --}}
        <x-booking-card :booking="$booking" />
    @empty
        <div class="alert alert-info text-center">
            You don't have any bookings yet.
        </div>
    @endforelse

{{-- Pagination --}}
<div class="d-flex justify-content-between align-items-center mt-4 flex-column flex-md-row">
    <div class="text-muted small mb-2 mb-md-0">
        Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} results
    </div>
    <nav>
        <ul class="pagination pagination-sm mb-0">

            {{-- Previous Page Link --}}
            @if ($bookings->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $bookings->previousPageUrl() }}">&laquo; Previous</a></li>
            @endif

            {{-- Page Numbers with "..." logic --}}
            @php
                $current = $bookings->currentPage();
                $last = $bookings->lastPage();
                $start = max(1, $current - 1);
                $end = min($last, $current + 1);
            @endphp

            @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $bookings->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $current == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $bookings->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($end < $last)
                @if ($end < $last - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $bookings->url($last) }}">{{ $last }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($bookings->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $bookings->nextPageUrl() }}">Next &raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
            @endif

        </ul>
    </nav>
</div>


</div>
@endsection
