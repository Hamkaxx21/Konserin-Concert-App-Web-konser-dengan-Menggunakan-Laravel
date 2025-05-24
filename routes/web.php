<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    EventController,
    BookingController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ForgotPasswordController,
    Auth\ResetPasswordController,
    UserProfileController,
    BlogController,
    FaqController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register all web routes here. Routes are loaded by RouteServiceProvider
| and assigned to the "web" middleware group.
|
*/

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

// Booking Routes
Route::middleware('auth')->group(function () {

    Route::get('/events/{slug}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/events/{slug}/book', [BookingController::class, 'addToCart'])->name('bookings.add-to-cart');

    Route::get('/cart', [BookingController::class, 'cart'])->name('cart');
    Route::delete('/cart/{index}', [BookingController::class, 'removeFromCart'])->name('cart.remove');

    Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [BookingController::class, 'process'])->name('checkout.process');

    Route::get('/booking/success', [BookingController::class, 'success'])->name('bookings.success');

    // User Profile Routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');

    // User Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Tes perubahan branch fitur-booking-status

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// FAQ Route
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Fallback Route - 404 page
Route::fallback(function () {
    return view('errors.404');
});
