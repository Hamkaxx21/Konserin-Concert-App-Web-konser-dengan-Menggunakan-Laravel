@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
    <section class="contact-header">
        <div class="container">
            <h1 class="text-center">Hubungi Kami</h1>
            <p class="text-center">Kami siap membantu Anda! Jangan ragu untuk menghubungi<br>kami jika ada pertanyaan, masukan, atau kerja sama.</p>
        </div>
    </section>

    <section class="contact-info">
        <div class="container">
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <span class="icon-location"></span>
                    </div>
                    <h3>Lokasi</h3>
                    <p>Unnes, Semarang, Indonesia</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <span class="icon-email"></span>
                    </div>
                    <h3>Email</h3>
                    <p>konserin@gmail.com</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <span class="icon-phone"></span>
                    </div>
                    <h3>Phone</h3>
                    <p>(62) 8123456789</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form-container">
                <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Get our stories delivered From<br>us to your inbox weekly.</h2>
                <div class="newsletter-form-container">
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email" required>
                        <button type="submit" class="btn btn-primary">Get started</button>
                    </form>
                </div>
                <p>Get a response tomorrow if you submit by 9pm today. If we received<br>after 9pm will get a reponse the following day.</p>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .contact-header {
        padding: 80px 0 40px;
        text-align: center;
    }

    .contact-header h1 {
        margin-bottom: 20px;
    }

    .contact-header p {
        color: var(--text-light);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin: 40px 0;
    }

    .info-card {
        text-align: center;
        padding: 30px;
    }

    .info-icon {
        width: 60px;
        height: 60px;
        background-color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 24px; /* Adjust icon size */
    }

    .icon-location::before {
        content: '\1F4CD'; /* Unicode for location pin */
    }

    .icon-email::before {
        content: '\2709'; /* Unicode for envelope */
    }

    .icon-phone::before {
        content: '\260E'; /* Unicode for telephone */
    }

    .info-card h3 {
        margin-bottom: 10px;
    }

    .info-card p {
        color: var(--text-light);
    }

    .contact-form-section {
        padding: 60px 0;
    }

    .contact-form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
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

    .newsletter-form-container {
        margin-bottom: 20px;
    }

    .newsletter-form {
        display: flex;
        gap: 10px;
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

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
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