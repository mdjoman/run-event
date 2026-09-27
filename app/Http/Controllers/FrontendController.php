<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Blog; 
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(10)->get();
        $active_event = Event::where('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->first();
        return view('index', compact('events', 'active_event'));
    }

    public function about()
    {
        return view('about');
    }

    public function event()
    {
        $active_event = Event::where('status', 'active')->latest()->first();

    $past_events = Event::where(function ($q) {
        $q->whereIn('status', ['completed', 'cancelled'])
              ->orWhere('event_date', '<', now());
        })
        ->orderByDesc('event_date')
        ->take(10)
        ->get();

        return view('event', compact('active_event', 'past_events'));
    }

    public function activity()
    {
        return view('activity');
    }

    public function blog()
    {
        $blogs = Blog::where('is_approved', 1)->latest()->paginate(6);
        return view('blog', compact('blogs'));
    }

    public function storeBlog(Request $request)
    {
        if ($request->passcode !== 'secret123') {
            return back()->withErrors(['passcode' => 'Incorrect Passcode! Article not published.']);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('blog_images', 'public');

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'comments_count' => $request->comments_count ?? 0,
            'image' => $imagePath,
            'is_approved' => 0,
        ]);

        return back()->with('success', 'Article submitted successfully! Waiting for admin approval.');
    }

    public function contact()
    {
        return view('contact');
    }
    public function gallery()
    {
        return view('gallery');
    }
    public function form()
    {
         $active_event = Event::where('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->first();
        return view('form', compact('active_event'));
    }

    public function clearCache()
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        \Artisan::call('optimize:clear');

        return '<pre>' . \Artisan::output() . '</pre>';
    }
}
