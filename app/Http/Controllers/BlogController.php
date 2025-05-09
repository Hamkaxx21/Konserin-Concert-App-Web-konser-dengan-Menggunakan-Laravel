<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // For now, return a simple view
        return view('blog.index');
    }

    public function show($slug)
    {
        // For now, return a simple view with the slug
        return view('blog.show', ['slug' => $slug]);
    }
}
