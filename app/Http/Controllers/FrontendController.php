<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Blog; 
use App\Models\Gallery;
use App\Models\GalleryCategory;
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
        $blogs = Blog::where('is_approved', 1)->latest()->paginate(4);
        $recentPosts = Blog::where('is_approved', 1)->latest()->take(4)->get();

        return view('blog', compact('blogs', 'recentPosts'));
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath,
            'is_approved' => 0,
        ]);

        return back()->with('success', 'Your article has been submitted successfully! It will be visible after admin approval.');
    }

    public function gallery()
    {
        $galleries = Gallery::where('status', 1)->latest()->get();
        $categories = GalleryCategory::all();

        return view('gallery', compact('galleries', 'categories'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'gallery_images' => 'required|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120', 
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $image->store('gallery', 'public');

                Gallery::create([
                    'category' => $request->category,
                    'image' => $imagePath,
                    'status' => 0,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully! They will be visible after admin approval.');
    }

    public function createGallery()
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery.create', compact('categories'));
    }
    public function contact()
    {
        return view('contact');
    }
    public function form(Request $request)
    {
        $eventId = $request->query('1');

        $active_event = Event::where('event_date', '>=', now())
            ->when($eventId, function ($query) use ($eventId) {
                $query->where('id', $eventId);
            })
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
