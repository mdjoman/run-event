<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'event_date'  => 'required|date',
            'start_time'  => 'required',
            'category'    => 'required|string|max:255',
            'fee'         => 'required|numeric|min:0',
            'slots'       => 'required|integer|min:1',
            'status'      => 'required|in:draft,active,completed,cancelled',
            'image'       => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($request->title) . '-' . time();
        $data['registered'] = 0;

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $event->load(['registrations' => fn ($q) => $q->latest()]);
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'event_date'  => 'required|date',
            'start_time'  => 'required',
            'category'    => 'required|string|max:255',
            'fee'         => 'required|numeric|min:0',
            'slots'       => 'required|integer|min:1',
            'status'      => 'required|in:draft,active,completed,cancelled',
            'image'       => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}