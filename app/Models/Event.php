<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'date',
        'time',
        'location',
        'venue',
        'organizer',
        'featured',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'featured' => 'boolean',
    ];

    /**
     * Get the tickets for the event.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get the categories for the event.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the artists for the event.
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    /**
     * Get the bookings for the event.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    /**
     * Scope a query to only include featured events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
    
    /**
     * Scope a query to only include upcoming events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date', 'asc');
    }
    
    /**
     * Get the URL for the event image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Check if image attribute is an external URL
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            // Check if image exists in public/images directory
            if (file_exists(public_path('images/' . $this->image))) {
                return asset('images/' . $this->image);
            }
            // Otherwise, assume it's a local storage path
            return asset('storage/' . $this->image);
        }
        // Default image if none set
        return asset('images/default-event.jpg');
    }
    
    /**
     * Get the formatted date for the event.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->date ? $this->date->format('d M Y') : '';
    }
    
    /**
     * Get the day of the month for the event.
     *
     * @return string
     */
    public function getDayAttribute()
    {
        return $this->date ? $this->date->format('d') : '';
    }
    
    /**
     * Get the month for the event.
     *
     * @return string
     */
    public function getMonthAttribute()
    {
        return $this->date ? $this->date->format('M') : '';
    }

    /**
     * Get the lowest ticket price for this event.
     *
     * @return float|null
     */
    public function getLowestPriceAttribute()
    {
        return $this->tickets()->min('price');
    }
}