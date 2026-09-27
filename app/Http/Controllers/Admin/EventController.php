<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $event = new Event(Event::getDefaultTemplate());
        return view('admin.events.create', compact('event'));
    }

    public function store(Request $request)
    {
        $data = $this->validateEvent($request);
        $data['slug'] = Str::slug($request->title) . '-' . time();
        $data['registered'] = 0;
        $data['is_featured'] = $request->boolean('is_featured');

        $data = $this->decodeJsonFields($data);
        $data = $this->applyDefaultsForEmpty($data);

        // ===== Handle file uploads =====
        $data['image']      = $this->handleImageUpload($request, 'image', 'image_path', null);
        $data['hero_image'] = $this->handleImageUpload($request, 'hero_image', 'hero_image_path', null);

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $event->load(['registrations' => fn($q) => $q->latest()]);
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validateEvent($request);
        $data['is_featured'] = $request->boolean('is_featured');

        $data = $this->decodeJsonFields($data);

        // ===== Handle file uploads (delete old if new uploaded) =====
        $data['image']      = $this->handleImageUpload($request, 'image', 'image_path', $event->image);
        $data['hero_image'] = $this->handleImageUpload($request, 'hero_image', 'hero_image_path', $event->hero_image);

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        // Delete associated files
        $this->deleteEventImage($event->image);
        $this->deleteEventImage($event->hero_image);

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    // ==================================================
    // VALIDATION
    // ==================================================
    private function validateEvent(Request $request): array
    {
        return $request->validate([
            // Basic
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:255',
            'presented_by' => 'nullable|string|max:255',
            'tagline'      => 'nullable|string|max:255',
            'location'     => 'required|string|max:255',
            'event_date'   => 'required|date',
            'start_time'   => 'required',
            'category'     => 'required|string|max:255',
            'fee'          => 'required|numeric|min:0',
            'slots'        => 'required|integer|min:1',
            'status'       => 'required|in:draft,active,completed,cancelled',
            'description'  => 'nullable|string',
            'race_type'    => 'nullable|string|max:100',
            'organizer'    => 'nullable|string|max:255',
            'is_featured'  => 'nullable|boolean',

            // ===== IMAGE UPLOADS =====
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',   // 5 MB
            'hero_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
            'image_path'       => 'nullable|string|max:500',   // fallback manual path
            'hero_image_path'  => 'nullable|string|max:500',

            // JSON fields
            'categories'   => 'nullable|string',
            'entitlements' => 'nullable|string',
            'awards'       => 'nullable|string',
            'schedules'    => 'nullable|string',
            'rules'        => 'nullable|string',
        ], [
            'image.image'   => 'Main image must be a valid image file.',
            'image.mimes'   => 'Main image must be JPG, JPEG, PNG, WEBP, or SVG.',
            'image.max'     => 'Main image must not exceed 5 MB.',
            'hero_image.image' => 'Hero image must be a valid image file.',
            'hero_image.mimes' => 'Hero image must be JPG, JPEG, PNG, WEBP, or SVG.',
            'hero_image.max'   => 'Hero image must not exceed 5 MB.',
        ]);
    }

    // ==================================================
    // DECODE JSON FIELDS
    // ==================================================
    private function decodeJsonFields(array $data): array
    {
        $jsonFields = ['categories', 'entitlements', 'awards', 'schedules', 'rules'];

        foreach ($jsonFields as $field) {
            if (array_key_exists($field, $data)) {
                $value = $data[$field];

                if (is_array($value)) continue;

                if (empty($value)) {
                    $data[$field] = null;
                    continue;
                }

                $decoded = json_decode($value, true);

                $data[$field] = (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                    ? $decoded
                    : null;
            }
        }

        return $data;
    }

    // ==================================================
    // APPLY DEFAULTS FOR EMPTY FIELDS
    // ==================================================
    private function applyDefaultsForEmpty(array $data): array
    {
        $defaults = Event::getDefaultTemplate();

        foreach (['subtitle', 'presented_by', 'tagline', 'race_type', 'organizer'] as $key) {
            if (empty($data[$key])) $data[$key] = $defaults[$key] ?? null;
        }

        foreach (['categories', 'entitlements', 'awards', 'schedules', 'rules'] as $key) {
            if (empty($data[$key])) $data[$key] = $defaults[$key] ?? null;
        }

        return $data;
    }

    // ==================================================
    // IMAGE UPLOAD HANDLER
    // ==================================================
    private function handleImageUpload(Request $request, string $fileKey, string $pathKey, ?string $oldPath): ?string
    {
        // 1. New file uploaded
        if ($request->hasFile($fileKey) && $request->file($fileKey)->isValid()) {
            // Delete old file if it was a storage file
            $this->deleteEventImage($oldPath);

            // Store new file
            return $request->file($fileKey)->store('events', 'public');
        }

        // 2. Manual path entered (fallback)
        if ($request->filled($pathKey)) {
            return $request->input($pathKey);
        }

        // 3. No change — keep old
        return $oldPath;
    }

    // ==================================================
    // DELETE IMAGE FILE
    // ==================================================
    private function deleteEventImage(?string $path): void
    {
        if (empty($path)) return;

        // Only delete files stored in storage/app/public
        if (Str::startsWith($path, 'events/')) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}