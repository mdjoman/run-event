<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events'        => Event::count(),
            'total_registrations' => Registration::count(),
            'pending_payments'    => Registration::where('status', 'pending')->count(),
            'completed_events'    => Event::where('status', 'completed')->count(),
        ];

        $recentRegistrations = Registration::with('event')
            ->latest()->take(5)->get();

        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'upcomingEvents'));
    }
}