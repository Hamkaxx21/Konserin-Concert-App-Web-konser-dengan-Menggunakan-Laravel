@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2 style="color: white;">Temukan Musik Sesuai Minat</h2>
                <h1>Rasakan Serunya Konser Terbaik di Tahun Ini!</h1>
                <p>Pesan tiketmu sekarang dan jangan lewatkan momen spektakuler bersama artis favoritmu!</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg">Pesan Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <div class="container">
        <div class="search-section">
            <form action="{{ route('events.index') }}" method="GET" class="search-form">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Event" aria-label="Search Event">
                </div>
                <div class="form-group">
                    <select name="location" class="form-select" aria-label="Location">
                        <option value="">Indonesia</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Bali">Bali</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="date" class="form-select" aria-label="Date">
                        <option value="">Any date</option>
                        <option value="today">Today</option>
                        <option value="tomorrow">Tomorrow</option>
                        <option value="this-week">This Week</option>
                        <option value="this-month">This Month</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <!-- Featured Events Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">KONSER EKSKLUSIF</h2>
            <p class="section-subtitle">Temukan konser yang sedang tren dan dapatkan tiket sebelum kehabisan!</p>
            
            <div class="event-grid">
                @foreach($featuredEvents as $event)
                <div class="event-card" style="padding: 20px;">
                    <div style="position: relative; min-height: 0;">
                        <div class="event-date" style="top: 10px; left: 10px; position: absolute;">
                            <span>{{ $event->day }}</span>
                            <span>{{ $event->month }}</span>
                        </div>
                    </div>
                    <div class="event-content" style="margin-top: 50px; padding-top: 10px;">
                        <h3 class="event-title">{{ $event->title }}</h3>
                        <p class="event-location">{{ $event->venue }}, {{ $event->location }}</p>
                        <p class="event-price">Mulai dari Rp {{ number_format($event->lowest_price, 0, ',', '.') }}</p>
                        <div class="event-actions">
                            <a href="{{ route('events.show', $event->slug) }}" class="btn btn-outline">Detail</a>
                            <a href="{{ route('bookings.create', $event->slug) }}" class="btn btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-xl">
                <a href="{{ route('events.index') }}" class="btn btn-outline">Lihat Semua Event</a>
            </div>
        </div>
    </section>

    <!-- Featured Artist Section -->
    <section class="section" style="background-color: var(--bg-light);">
        <div class="container">
            @if($featuredArtists->isNotEmpty())
                @php $featuredArtist = $featuredArtists->first(); @endphp
                <div class="featured-artist">
                    <div class="artist-image">
                        <img src="https://i.pinimg.com/736x/01/16/24/011624a1e9b954d53c975522519fec71.jpg" alt="Hindia">
                    </div>
                    <div class="artist-content">
                        <h2 class="artist-name">Hindia</h2>
                        <p class="artist-bio">
                            Bersiaplah untuk malam penuh sensasi bersama Hindia. Dengan suara merdu dan lirik yang penuh makna, semuanya akan terbawa dalam sensasi venue dengan lagu-lagu andalan. Nikmati setiap set dan dapatkan pengalaman spesial untuk melihat langsung momen istimewa ini. Jadikan konser ini tak terlupakan dengan bergabung di barisan depan untuk menjadi bagian dari perjalanan musik {{ $featuredArtist->name }}.
                        </p>
                        <a href="{{ route('events.index') }}?artist={{ $featuredArtist->id }}" class="btn btn-primary">Lihat Konser</a>
                    </div>
                </div>
            @endif
            
            <div class="section-title">
                <h2>Tur Berjalan</h2>
            </div>
            
            <div class="featured-artist">
                <div class="artist-content">
                    <h2 class="artist-name">Tur Berjalan</h2>
                    <p class="artist-bio">
                        Dapatkan tiketmu sekarang dan nikmati tempat terbaik untuk konser yang tak terlupakan! Nikmati momen yang penuh energi positif bersama teman-teman atau orang tersayang dan rasakan keseruan yang belum pernah kamu alami sebelumnya.
                    </p>
                    <a href="{{ route('events.index') }}" class="btn btn-primary">Pesan Tiket</a>
                </div>
                <div class="artist-image">
                    <img src="https://images.pexels.com/photos/1105666/pexels-photo-1105666.jpeg" alt="Concert Tour">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Fitur Aplikasi</h2>
            <p class="section-subtitle">Kualitas adalah prioritas kami</p>
            
            <div class="features">
                <div class="feature">
                    <img src="{{ asset('images/easy_booking.png') }}" alt="Easy Booking" class="feature-icon">
                    <h3 class="feature-title">Pemesanan Sederhana</h3>
                    <p class="feature-description">Proses pemesanan tiket yang mudah dan cepat untuk pengalaman terbaik.</p>
                </div>
                
                <div class="feature">
                    <img src="{{ asset('images/best_quality.png') }}" alt="Best Quality" class="feature-icon">
                    <h3 class="feature-title">Kualitas Terbaik</h3>
                    <p class="feature-description">Konser dengan kualitas produksi terbaik dan pengalaman premium.</p>
                </div>
                
                <div class="feature">
                    <img src="{{ asset('images/secure.png') }}" alt="Secure Tickets" class="feature-icon">
                    <h3 class="feature-title">Pilihan Tiket Flexibel</h3>
                    <p class="feature-description">Berbagai pilihan tiket untuk memastikan semua orang dapat menikmati.</p>
                </div>
                
                <div class="feature">
                    <img src="{{ asset('images/24_support.png') }}" alt="24/7 Support" class="feature-icon">
                    <h3 class="feature-title">Akses Mudah</h3>
                    <p class="feature-description">Informasi lengkap tentang transportasi dan akses ke lokasi konser.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="section" style="background-color: var(--bg-light);">
        <div class="container">
            <div class="featured-artist">
                <div class="artist-content">
                    <h2 class="artist-name">Hubungi Kami</h2>
                    <p class="artist-bio">Bergabunglah dengan Kami</p>
                    <p>Untuk mengetahui lebih lanjut tentang konser yang akan datang dan mendapatkan penawaran khusus, silakan berlangganan newsletter kami.</p>
                    
                    <form action="#" method="POST" class="mt-lg">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-md">Subscribe</button>
                    </form>
                </div>
                <div class="artist-image">
                    <img src="https://images.pexels.com/photos/1190298/pexels-photo-1190298.jpeg" alt="Newsletter">
                </div>
            </div>
        </div>
    </section>
@endsection