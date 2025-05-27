@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>About Us</h1>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    <img src="https://i.pinimg.com/736x/de/7c/23/de7c23d027c9bdcb93d3dc070b213001.jpg" alt="Customer Service">
                </div>
                <div class="about-content">
                    <p class="about-text">
                        Kami adalah platform terpercaya untuk pembelian tiket konser lokal dan internasional. Dengan komitmen memberikan pengalaman terbaik, kami menghadirkan akses mudah, pembayaran aman, dan informasi lengkap seputar konser favoritmu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section">
        <div class="container">
            <div class="vision-grid">
                <div class="vision-content">
                    <p class="vision-text">
                        Kami lahir dari kecintaan terhadap musik dan pengalaman live yang tak tergantikan. Misi kami sederhana: menghubungkan para penggemar dengan artis idola mereka melalui layanan tiket yang cepat, nyaman, dan terpercaya. Kami membayangkan dunia di mana semua orang bisa menikmati konser impian mereka tanpa hambatan — dan kami di sini untuk mewujudkannya
                    </p>
                </div>
                <div class="vision-image">
                    <img src="https://images.pexels.com/photos/2747449/pexels-photo-2747449.jpeg" alt="Concert Experience">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Tim Kami</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="{{ asset('images/hamka.jpg') }}" alt="Muhammad Hamka Shiddiq" class="team-photo">
                    <h3>Muhammad Hamka Shiddiq</h3>
                    <p>Project Manager</p>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/excell.jpg') }}" alt="Arilano Exceloveli Pinem" class="team-photo">
                    <h3>Arilano Exceloveli Pinem</h3>
                    <p>Front-End</p>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/bima.jpg') }}" alt="Bima Arjuna" class="team-photo">
                    <h3>Bima Arjuna</h3>
                    <p>Creative Director</p>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/kezia.jpg') }}" alt="Kezia Gabriella Saroinsong" class="team-photo">
                    <h3>Kezia Gabriella Saroinsong</h3>
                    <p>Marketing</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title">Apa yang pengguna katakan</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <p class="testimonial-text">
                        Suasananya luar biasa, semua orang bernyanyi bersama dan energi di venue benar-benar hidup!
                    </p>
                    <div class="testimonial-author">
                        <img src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg" alt="User" class="author-photo">
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <p>Music Enthusiast</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">
                        Pengalaman konser terbaik yang pernah saya rasakan — panggung, suara, dan penampilan artisnya benar-benar sempurna
                    </p>
                    <div class="testimonial-author">
                        <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg" alt="User" class="author-photo">
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>Regular Concert-goer</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">
                        Pembelian tiket sangat mudah dan customer service-nya sangat membantu!
                    </p>
                    <div class="testimonial-author">
                        <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg" alt="User" class="author-photo">
                        <div class="author-info">
                            <h4>Emma Davis</h4>
                            <p>First-time User</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .about-hero {
        background-color: var(--primary-color);
        color: var(--text-white);
        padding: var(--spacing-xxl) 0;
        text-align: center;
    }

    .about-hero h1 {
        font-size: var(--font-xxxl);
        color: var(--text-white);
        margin: 0;
    }

    .about-section,
    .vision-section {
        padding: var(--spacing-xxl) 0;
    }

    .about-grid,
    .vision-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--spacing-xl);
        align-items: center;
    }

    .about-image img,
    .vision-image img {
        width: 100%;
        height: auto;
        border-radius: var(--radius-lg);
    }

    .about-text,
    .vision-text {
        font-size: var(--font-lg);
        line-height: 1.6;
        color: var(--text-color);
    }

    .team-section {
        padding: var(--spacing-xxl) 0;
        background-color: var(--bg-light);
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--spacing-xl);
        margin-top: var(--spacing-xl);
    }

    .team-member {
        text-align: center;
    }

    .team-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: var(--spacing-md);
    }

    .team-member h3 {
        margin-bottom: var(--spacing-xs);
        font-size: var(--font-md);
    }

    .team-member p {
        color: var(--text-light);
    }

    .testimonials-section {
        padding: var(--spacing-xxl) 0;
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--spacing-xl);
        margin-top: var(--spacing-xl);
    }

    .testimonial {
        background-color: var(--bg-white);
        padding: var(--spacing-lg);
        border-radius: var(--radius-lg);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .testimonial-text {
        margin-bottom: var(--spacing-lg);
        font-size: var(--font-md);
        line-height: 1.6;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
    }

    .author-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: var(--spacing-md);
    }

    .author-info h4 {
        margin-bottom: var(--spacing-xs);
        font-size: var(--font-base);
    }

    .author-info p {
        color: var(--text-light);
        font-size: var(--font-sm);
    }

    @media (max-width: 992px) {
        .about-grid,
        .vision-grid {
            grid-template-columns: 1fr;
        }

        .team-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .testimonials-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .team-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection