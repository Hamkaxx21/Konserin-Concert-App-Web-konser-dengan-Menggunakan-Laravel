<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'booking_number',
        'total_amount',
        'payment_status',
        'payment_method',
        'transaction_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'float',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event for the booking.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the booking items for the booking.
     */
    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }

    /**
     * Get the formatted total amount for the booking.
     *
     * @return string
     */
    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }
    
    /**
     * Generate a unique booking number.
     *
     * @return string
     */
    public static function generateBookingNumber()
    {
        $prefix = 'KSR';
        $date = now()->format('Ymd');
        $randomNumber = mt_rand(1000, 9999);
        $bookingNumber = $prefix . $date . $randomNumber;
        
        // Ensure the booking number is unique
        while (self::where('booking_number', $bookingNumber)->exists()) {
            $randomNumber = mt_rand(1000, 9999);
            $bookingNumber = $prefix . $date . $randomNumber;
        }
        
        return $bookingNumber;
    }
}