@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $event->slug) }}" required>
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $event->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Event Image</label><br>
            @if($event->image_url)
                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" style="max-width: 200px; margin-bottom: 10px;">
            @endif
            <input type="file" name="image" id="image" class="form-control-file">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}" required>
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="time">Time</label>
            <input type="text" name="time" id="time" class="form-control" value="{{ old('time', $event->time) }}">
            @error('time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}">
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" name="venue" id="venue" class="form-control" value="{{ old('venue', $event->venue) }}">
            @error('venue')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="organizer">Organizer</label>
            <input type="text" name="organizer" id="organizer" class="form-control" value="{{ old('organizer', $event->organizer) }}">
            @error('organizer')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group form-check">
            <input type="checkbox" name="featured" id="featured" class="form-check-input" value="1" {{ old('featured', $event->featured) ? 'checked' : '' }}>
            <label for="featured" class="form-check-label">Featured</label>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $event->status) }}">
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
