<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(10)->get();
        return view('index', compact('events'));
    }

    public function about()
    {
        return view('about');
    }

    public function event()
    {
        $events = Event::latest()->paginate(10);
        return view('event', compact('events'));
    }

    public function activity()
    {
        return view('activity');
    }

    public function service()
    {
        return view('service');
    }

    public function contact()
    {
        return view('contact');
    }
    public function form()
    {
        return view('form');
    }

    /**
     * TEMPORARY: Clear all caches from browser.
     * Visit: /clear-cache
     * Delete this method + route after use (or keep guarded by env check).
     */
    public function clearCache()
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        \Artisan::call('optimize:clear');

        return '<pre>' . \Artisan::output() . '</pre>';
    }
}
