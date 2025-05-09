<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Get featured events
        $featuredEvents = Event::featured()->upcoming()->take(4)->get();
        
        // Get upcoming events
        $upcomingEvents = Event::upcoming()->take(8)->get();
        
        // Get featured artists
        $featuredArtists = Artist::featured()->take(3)->get();
        
        // Get event categories
        $categories = Category::withCount('events')->orderBy('events_count', 'desc')->take(6)->get();
        
        return view('home', compact('featuredEvents', 'upcomingEvents', 'featuredArtists', 'categories'));
    }
    
    /**
     * Display the about page.
     */
    public function about()
    {
        return view('about');
    }
    
    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('contact');
    }
    
    /**
     * Process the contact form.
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Here you would typically send an email or store the contact request
        
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}