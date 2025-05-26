@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-container">
    <div class="auth-image"></div>
    <div class="auth-form-container">
        <div class="auth-form-wrapper">
            <h1>Create your account</h1>
            <p class="auth-subtitle">It's free and easy</p>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
                
                <!-- Name -->
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Type your e-mail or phone number" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Type your password" required>
                    <div class="password-hint">Must be 8 characters at least</div>
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Terms Agreement -->
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                        <label for="terms" class="form-check-label">
                            By creating an account means you agree to the <a href="#">Terms and Conditions</a>, and our <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>

                <!-- Divider -->
                <div class="auth-divider">
                    <span>or do it via other accounts</span>
                </div>

                <!-- Social Login -->
                <div class="social-login">
                    <a href="#" class="social-btn google">
                        <img src="{{ asset('images/google-logo.png') }}" alt="Google">
                    </a>
                    <a href="#" class="social-btn apple">
                        <img src="{{ asset('images/apple-logo.png') }}" alt="Apple">
                    </a>
                    <a href="#" class="social-btn facebook">
                        <img src="{{ asset('images/facebook-logo.png') }}" alt="Facebook">
                    </a>
                </div>

                <!-- Redirect to login -->
                <p class="auth-footer">
                    Already have an account? <a href="{{ route('login') }}">Sign In</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.auth-container {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.auth-image {
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg');
    background-size: cover;
    background-position: center;
}

.auth-form-container {
    background: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--spacing-xl);
}

.auth-form-wrapper {
    width: 100%;
    max-width: 400px;
}

.auth-form-wrapper h1 {
    color: var(--text-white);
    margin-bottom: var(--spacing-xs);
    font-size: var(--font-xxl);
}

.auth-subtitle {
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: var(--spacing-xl);
}

.auth-form .form-control {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: var(--text-white);
    padding: var(--spacing-md);
}

.auth-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.password-hint {
    color: rgba(255, 255, 255, 0.5);
    font-size: var(--font-sm);
    margin-top: var(--spacing-xs);
}

.form-check {
    margin-top: var(--spacing-md);
}

.form-check-label {
    color: rgba(255, 255, 255, 0.7);
    font-size: var(--font-sm);
    margin-left: var(--spacing-sm);
}

.form-check-label a {
    color: var(--text-white);
    text-decoration: underline;
}

.auth-divider {
    text-align: center;
    margin: var(--spacing-lg) 0;
    color: rgba(255, 255, 255, 0.7);
    position: relative;
}

.auth-divider::before,
.auth-divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 30%;
    height: 1px;
    background: rgba(255, 255, 255, 0.2);
}

.auth-divider::before {
    left: 0;
}

.auth-divider::after {
    right: 0;
}

.social-login {
    display: flex;
    justify-content: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-lg);
}

.social-btn {
    width: 40px;
    height: 40px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-btn img {
    width: 20px;
    height: 20px;
}

.auth-footer {
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
}

.auth-footer a {
    color: var(--text-white);
    font-weight: 600;
}

@media (max-width: 768px) {
    .auth-container {
        grid-template-columns: 1fr;
    }

    .auth-image {
        display: none;
    }
}
</style>
@endsection