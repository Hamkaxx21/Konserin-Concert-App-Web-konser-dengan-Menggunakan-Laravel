<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index(Request $request)
    {
        $query = Event::query();
        
        // Apply search filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('venue', 'like', "%{$search}%");
        }
        
        // Apply category filter
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category);
            });
        }
        
        // Apply location filter
        if ($request->has('location')) {
            $location = $request->input('location');
            $query->where('location', 'like', "%{$location}%");
        }
        
        // Apply date filter
        if ($request->has('date')) {
            $date = $request->input('date');
            if ($date === 'today') {
                $query->whereDate('date', today());
            } elseif ($date === 'tomorrow') {
                $query->whereDate('date', today()->addDay());
            } elseif ($date === 'this-week') {
                $query->whereBetween('date', [today(), today()->addDays(7)]);
            } elseif ($date === 'this-month') {
                $query->whereMonth('date', today()->month);
            } else {
                $query->whereDate('date', $date);
            }
        }
        
        // Get upcoming events
        $events = $query->upcoming()->paginate(12);
        
        // Get all categories for the filter
        $categories = Category::all();
        
        return view('events.index', compact('events', 'categories'));
    }

    /**
     * Display the specified event.
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)
                      ->with(['tickets', 'categories', 'artists'])
                      ->firstOrFail();
        
        // Get related events
        $relatedEvents = Event::whereHas('categories', function ($query) use ($event) {
                                    $query->whereIn('categories.id', $event->categories->pluck('id'));
                                })
                                ->where('id', '!=', $event->id)
                                ->upcoming()
                                ->limit(4)
                                ->get();
        
        return view('events.show', compact('event', 'relatedEvents'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events,slug,' . $event->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'status' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image && \Storage::disk('public')->exists($event->image)) {
                \Storage::disk('public')->delete($event->image);
            }
            // Store new image
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('events.show', $event->slug)->with('success', 'Event updated successfully.');
    }
}