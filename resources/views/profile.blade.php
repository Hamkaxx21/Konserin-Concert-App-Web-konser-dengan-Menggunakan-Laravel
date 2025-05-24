@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="profile-container">
    <div class="sidebar">
        <ul>
            <li class="active"><i class="fas fa-user"></i> Personal Info</li>
            <li><i class="fas fa-lock"></i> Login and Security</li>
            <li><i class="fas fa-credit-card"></i> My Payments</li>
            <li><i class="fas fa-ticket-alt"></i> My Voucher</li>
            <li><i class="fas fa-star"></i> My Points</li>
            <li><i class="fas fa-box"></i> My Orders</li>
        </ul>
    </div>

    <div class="profile-content">
        <h2>Profile Anda</h2>
        <h4>Info Akun</h4>

        @if(session('success'))
            <div style="color: green; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label>Display Name</label>
                    <input type="text" name="display_name" placeholder="Display Name" 
                        value="{{ old('display_name', auth()->user()->display_name) }}" required>
                    @error('display_name')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Real Name</label>
                    <input type="text" name="real_name" placeholder="Real Name" 
                        value="{{ old('real_name', auth()->user()->real_name) }}" required>
                    @error('real_name')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="Phone Number" 
                        value="{{ old('phone', auth()->user()->phone) }}" required>
                    @error('phone')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email" 
                        value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="New Password">
                    @error('password')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                </div>
            </div>

            <button type="submit" class="btn-update">Update Profile</button>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .profile-container {
        display: flex;
        max-width: 1000px;
        margin: 40px auto;
        gap: 40px;
    }

    .sidebar {
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        width: 220px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        padding: 12px 16px;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #333;
    }

    .sidebar li.active,
    .sidebar li:hover {
        background-color: #f0f4ff;
        color: #0044cc;
        font-weight: 600;
    }

    .profile-content {
        flex: 1;
    }

    .profile-content h2 {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .profile-content h4 {
        font-size: 18px;
        margin-bottom: 24px;
        color: #666;
    }

    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-row {
        display: flex;
        gap: 20px;
    }

    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 6px;
        font-weight: 500;
        color: #444;
    }

    .form-group input {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .btn-update {
        align-self: flex-start;
        padding: 12px 20px;
        background-color: #001e6c;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .btn-update:hover {
        background-color: #002f8c;
    }
</style>
@endsection
