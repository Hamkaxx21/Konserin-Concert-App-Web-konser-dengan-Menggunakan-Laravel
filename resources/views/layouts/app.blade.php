<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Konserin') }} - @yield('title', 'Concert Event Website')</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    
    @yield('styles')
</head>
<!-- Bootstrap 5 Bundle JS (dengan Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body class="d-flex flex-column min-vh-100">
    <header class="header">
        <div class="container">
            <nav class="main-nav">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/konserin-Logo.png') }}" alt="Konserin Logo">
                    </a>
                </div>
                
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'active' : '' }}">Explore Events</a></li>
                    <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                
                <div class="nav-auth">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-text">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @else
                        <a href="{{ route('cart') }}" class="cart-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="cart-count">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                        <div class="user-dropdown">
                            <button class="dropdown-toggle">
                                <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="avatar">
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('profile') }}">My Profile</a>
                                <a href="{{ route('bookings') }}">My Bookings</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </nav>
        </div>
    </header>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @if (!request()->routeIs('login') && !request()->routeIs('register'))
    <footer class="footer mt-auto">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo">
                        <img src="{{ asset('images/konserin-putih.png') }}" alt="Konserin Logo">
                    </div>
                    <p>Your ultimate destination for discovering and booking the best concerts and events.</p>
                </div>
                
                <div class="footer-links">
                    <div class="footer-col">
                        <h4>Konserin</h4>
                        <ul>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('faq') }}">Help / FAQ</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-col">
                        <h4>Social Media</h4>
                        <ul class="social-media-logos" style="display: flex; gap: 10px; padding-left: 0; list-style: none;">
                            <li><a href="#"><img src="{{ asset('images/facebook-logo.png') }}" alt="Facebook" style="width: 24px; height: 24px;"></a></li>
                            <li><a href="#"><img src="{{ asset('images/twitter-logo.png') }}" alt="Twitter" style="width: 24px; height: 24px;"></a></li>
                            <li><a href="#"><img src="{{ asset('images/wa-logo.png') }}" alt="WhatsApp" style="width: 24px; height: 24px;"></a></li>
                            <li><a href="#"><img src="{{ asset('images/instagram-logo.png') }}" alt="Instagram" style="width: 24px; height: 24px;"></a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-col">
                        <h4>Download Aplikasi</h4>
                        <div class="app-downloads">
                            <a href="#" class="app-link">
                                <img src="{{ asset('images/appstore-logo.png') }}" alt="Download on App Store">
                            </a>
                            <a href="#" class="app-link">
                                <img src="{{ asset('images/googlehitam-logo.png') }}" alt="Download on Google Play">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <p class="copyright">Copyright © 2025. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
