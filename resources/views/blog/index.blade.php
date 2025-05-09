@extends('layouts.app')

@section('title', 'Blog & Berita Musik Terkini')

@section('content')
    <section class="blog-header">
        <div class="container">
            <h6 class="text-center">OUR BLOGS</h6>
            <h1 class="text-center">Blog & Berita Musik Terkini</h1>
            <p class="text-center">Temukan info terbaru seputar konser, rilis lagu, kolaborasi artis, dan cerita menarik dari dunia musik — semuanya kami sajikan khusus untuk kamu, pecinta musik sejati!</p>
        </div>
    </section>

    <section class="blog-grid">
        <div class="container">
            <div class="blog-posts">
                <!-- Row 1 -->
                <div class="blog-row">
                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg" alt="Bernadya">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">13 April 2025</div>
                            <h2>Bernadya Umumkan Tur di 5 Kota Besar</h2>
                            <p>Tur bertajuk "Dekat dan Bermakna" ini akan dimulai Juni mendatang. Tiket mulai dijual minggu depan, jangan sampai kehabisan!</p>
                            <a href="#" class="read-more">Read More...</a>
                        </div>
                    </article>

                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="https://images.pexels.com/photos/1644888/pexels-photo-1644888.jpeg" alt="Kolaborasi">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">9 April 2025</div>
                            <h2>Kolaborasi Mengejutkan: Pamungkas x Isyana</h2>
                            <p>Dua musisi dengan gaya berbeda ini resmi mengumumkan single kolaborasi yang akan dirilis bulan depan. Antusias penggemar meledak!</p>
                            <a href="#" class="read-more">Read More...</a>
                        </div>
                    </article>

                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg" alt="Festival">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">22 Maret 2025</div>
                            <h2>Festival Musim Panas 2025 Resmi Diumumkan</h2>
                            <p>Lebih dari 20 musisi lokal dan internasional akan tampil di satu panggung besar. Siapkan dirimu untuk pengalaman musik luar biasa!</p>
                            <a href="#" class="read-more">Read More...</a>
                        </div>
                    </article>
                </div>

                <!-- Row 2 -->
                <div class="blog-row">
                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="https://images.pexels.com/photos/1699161/pexels-photo-1699161.jpeg" alt="Raisa">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">15 April 2025</div>
                            <h2>Raisa Siap Gelar Konser Orkestra di Jakarta</h2>
                            <p>Raisa akan tampil bersama orkestra penuh dalam konser bertema "Sinfoni Cinta". Konser eksklusif ini hanya digelar satu malam</p>
                            <a href="#" class="read-more">Read More...</a>
                        </div>
                    </article>

                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="https://images.pexels.com/photos/1699161/pexels-photo-1699161.jpeg" alt="Aulia">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">8 April 2025</div>
                            <h2>Penyanyi Baru: Aulia Zahra Curi Perhatian Lewat Lagu Debutnya</h2>
                            <p>Single debut berjudul "Langit Senja" langsung trending di berbagai platform. Suara lembut dan lirik mendalam jadi daya tarik utama Aulia.</p>
                            <a href="#" class="read-more">Read More...</a>
                        </div>
                    </article>

                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg" alt="Konser Amal">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">22 Maret 2025</div>
                            <h2>Konser Amal "Nada untuk Negeri" Kumpulkan Dana Pendidikan</h2>
                            <p>Gabungan musisi ternama Indonesia menggelar konser amal di Yogyakarta. Seluruh hasil penjualan tiket disalurkan untuk beasiswa anak-anak kurang mampu.</p>
                            <a href="#" class="read-more">Read More...</a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Masukkan Email Anda untuk<br>Berita & Info Terbaru!</h2>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your Email" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
                <p>Jadilah yang pertama tahu tentang konser terbaru, penjualan tiket,<br>dan promo spesial langsung dari inbox-mu. Gratis, cepat, dan<br>tanpa spam!</p>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .blog-header {
        padding: 80px 0;
        text-align: center;
    }

    .blog-header h6 {
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .blog-header h1 {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .blog-header p {
        max-width: 800px;
        margin: 0 auto;
        color: var(--text-light);
    }

    .blog-grid {
        padding: 40px 0;
        display: flex;
        justify-content: center;
    }

    .blog-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 30px;
    }

    .blog-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    width: 300px; /* Set the desired width */
    height: 400px; /* Set the desired height */
    display: flex;
    flex-direction: column;
}

    .blog-card:hover {
        transform: translateY(-5px);
    }

    .blog-image {
        height: 200px;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-content {
        padding: 20px;
    }

    .blog-date {
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 10px;
    }

    .blog-content h2 {
        font-size: 20px;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .blog-content p {
        color: var(--text-light);
        margin-bottom: 15px;
        font-size: 14px;
        line-height: 1.6;
    }

    .read-more {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
    }

    .newsletter-section {
        background: linear-gradient(rgba(0, 20, 64, 0.9), rgba(0, 20, 64, 0.9)), 
                    url('https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        color: white;
        text-align: center;
    }

    .newsletter-content {
        max-width: 600px;
        margin: 0 auto;
    }

    .newsletter-content h2 {
        color: white;
        margin-bottom: 30px;
    }

    .newsletter-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        justify-content: center;
    }

    .newsletter-form input {
        width: 300px;
        padding: 12px;
        border: none;
        border-radius: 6px;
    }

    .newsletter-content p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .blog-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .blog-row {
            grid-template-columns: 1fr;
        }

        .newsletter-form {
            flex-direction: column;
            align-items: center;
        }

        .newsletter-form input {
            width: 100%;
            max-width: 300px;
        }
    }
</style>
@endsection