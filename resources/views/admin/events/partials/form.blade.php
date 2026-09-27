{{-- resources/views/admin/events/partials/form.blade.php --}}
{{-- Variables: $event (Event instance), $mode ('create' | 'edit') --}}

@php
    $mode     = $mode ?? 'create';
    $isEdit   = $mode === 'edit';

    $categories   = old('categories_decoded',   $event->categories   ?? []);
    $entitlements = old('entitlements_decoded', $event->entitlements ?? []);
    $awards       = old('awards_decoded',       $event->awards       ?? []);
    $schedules    = old('schedules_decoded',    $event->schedules    ?? []);
    $rules        = old('rules_decoded',        $event->rules        ?? []);

    // Populate defaults for create mode when empty
    if ($mode === 'create' && empty($categories)) {
        $defaults = \App\Models\Event::getDefaultTemplate();
        $categories   = $defaults['categories']   ?? [];
        $entitlements = $defaults['entitlements'] ?? [];
        $awards       = $defaults['awards']       ?? [];
        $schedules    = $defaults['schedules']    ?? [];
        $rules        = $defaults['rules']        ?? [];

        if (empty($event->subtitle))     $event->subtitle     = $defaults['subtitle']     ?? null;
        if (empty($event->presented_by)) $event->presented_by = $defaults['presented_by'] ?? null;
        if (empty($event->tagline))      $event->tagline      = $defaults['tagline']      ?? null;
        if (empty($event->race_type))    $event->race_type    = $defaults['race_type']    ?? null;
        if (empty($event->organizer))    $event->organizer    = $defaults['organizer']    ?? null;
    }
@endphp

{{-- =================== BASIC INFO =================== --}}
{{-- Summernote CSS --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <h3 class="text-sm font-extrabold text-slate-800 mb-4 pb-3 border-b border-slate-100">
        <i class="fa-solid fa-circle-info text-brandPink mr-1"></i> Basic Information
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="md:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Event Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $event->subtitle ?? '') }}"
                   placeholder="Second Edition"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Presented By</label>
            <input type="text" name="presented_by" value="{{ old('presented_by', $event->presented_by ?? '') }}"
                   placeholder="Run BURJOWAN Proudly Presents"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Tagline</label>
            <input type="text" name="tagline" value="{{ old('tagline', $event->tagline ?? '') }}"
                   placeholder="More Than a Race, It's a Movement."
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Location <span class="text-red-500">*</span>
            </label>
            <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}" required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Category Label <span class="text-red-500">*</span>
                <span class="text-[10px] text-slate-400 font-normal normal-case">(short summary)</span>
            </label>
            <input type="text" name="category" value="{{ old('category', $event->category ?? '') }}"
                   placeholder="21.1K / 15K / 7.5K" required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Event Date <span class="text-red-500">*</span>
            </label>
            <input type="date" name="event_date"
                   value="{{ old('event_date', isset($event->event_date) && $event->event_date ? $event->event_date->format('Y-m-d') : '') }}"
                   required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Start Time <span class="text-red-500">*</span>
            </label>
            <input type="time" name="start_time" value="{{ old('start_time', $event->start_time ?? '') }}" required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Fee (BDT) <span class="text-red-500">*</span>
            </label>
            <input type="number" step="0.01" name="fee" value="{{ old('fee', $event->fee ?? 0) }}" required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Total Slots <span class="text-red-500">*</span>
            </label>
            <input type="number" name="slots" value="{{ old('slots', $event->slots ?? 100) }}" required
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                Status <span class="text-red-500">*</span>
            </label>
            <select name="status" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                           focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                @foreach(['draft','active','completed','cancelled'] as $st)
                    <option value="{{ $st }}" @selected(old('status', $event->status ?? 'draft') === $st)>
                        {{ ucfirst($st) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Race Type</label>
            <input type="text" name="race_type" value="{{ old('race_type', $event->race_type ?? 'Live Road Race') }}"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Organizer</label>
            <input type="text" name="organizer" value="{{ old('organizer', $event->organizer ?? 'Run BURJOWAN') }}"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        {{-- =================== DESCRIPTION (Summernote) =================== --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                <i class="fa-solid fa-align-left mr-1 text-brandPink"></i> Description
            </label>

            {{-- Hidden textarea — actual form value এখানে --}}
            <textarea name="description" id="ev_description" class="hidden">{{ old('description', $event->description ?? '') }}</textarea>

            {{-- Summernote editor container --}}
            <div id="summernote-editor"
                class="bg-white border border-slate-200 rounded-lg overflow-hidden
                        focus-within:ring-2 focus-within:ring-brandPink focus-within:border-transparent transition"></div>
        </div>

        <div class="md:col-span-2">
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1"
                       @checked(old('is_featured', $event->is_featured ?? false))
                       class="w-4 h-4 rounded border-slate-300 text-brandPink focus:ring-brandPink">
                <span class="text-sm font-semibold text-slate-700">
                    <i class="fa-solid fa-star text-yellow-500 mr-1"></i> Mark as Featured Event
                </span>
            </label>
        </div>

    </div>
</div>

{{-- =================== IMAGE UPLOADS =================== --}}
<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <h3 class="text-sm font-extrabold text-slate-800 mb-4 pb-3 border-b border-slate-100">
        <i class="fa-solid fa-image text-brandPink mr-1"></i> Images
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- ===== MAIN IMAGE ===== --}}
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                Main Image <span class="text-[10px] text-slate-400 font-normal normal-case">(max 5 MB)</span>
            </label>

            <div class="space-y-3">

                {{-- Preview --}}
                <div class="aspect-video bg-slate-100 rounded-lg overflow-hidden border border-slate-200 flex items-center justify-center">
                    @php
                        $existingImage = $event->image ?? null;
                        $isStorage     = $existingImage && \Illuminate\Support\Str::startsWith($existingImage, 'events/');
                        $existingUrl   = $isStorage ? asset('storage/' . $existingImage) : null;
                    @endphp

                    <img id="ev_image_preview"
                         src="{{ $existingUrl ?? '' }}"
                         alt=""
                         class="w-full h-full object-cover {{ $existingUrl ? '' : 'hidden' }}"
                         onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');">

                    <div id="ev_image_placeholder"
                         class="text-center text-slate-400 {{ $existingUrl ? 'hidden' : '' }}">
                        <i class="fa-regular fa-image text-3xl mb-2"></i>
                        <p class="text-[11px] font-semibold">No image</p>
                    </div>
                </div>

                {{-- File upload button --}}
                <label for="ev_image_file"
                       class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-lg
                              bg-brandPink text-white text-sm font-semibold cursor-pointer
                              hover:bg-pink-700 transition shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Choose File</span>
                    <input id="ev_image_file" name="image" type="file" accept="image/*"
                           class="hidden" onchange="previewImage(this, 'ev_image_preview', 'ev_image_placeholder')">
                </label>

                {{-- Filename --}}
                <p id="ev_image_filename" class="text-[11px] text-slate-500 text-center truncate"></p>

                @if($existingImage)
                    <p class="text-[10px] text-slate-400 text-center truncate font-mono" title="{{ $existingImage }}">
                        Current: {{ $existingImage }}
                    </p>
                @endif

                {{-- Manual path fallback --}}
                <details class="text-[11px]">
                    <summary class="cursor-pointer text-slate-500 hover:text-brandPink font-semibold">
                        <i class="fa-solid fa-link mr-1"></i> Or use manual path
                    </summary>
                    <input type="text" name="image_path"
                           value="{{ old('image_path', ($existingImage && !$isStorage) ? $existingImage : '') }}"
                           placeholder="img/url.jpeg"
                           class="mt-2 w-full px-3 py-1.5 border border-slate-200 rounded text-xs
                                  focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                </details>

            </div>
        </div>

        {{-- ===== HERO IMAGE ===== --}}
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                Hero Image <span class="text-[10px] text-slate-400 font-normal normal-case">(max 5 MB)</span>
            </label>

            <div class="space-y-3">

                {{-- Preview --}}
                <div class="aspect-video bg-slate-100 rounded-lg overflow-hidden border border-slate-200 flex items-center justify-center">
                    @php
                        $existingHero = $event->hero_image ?? null;
                        $heroIsStorage = $existingHero && \Illuminate\Support\Str::startsWith($existingHero, 'events/');
                        $heroUrl       = $heroIsStorage ? asset('storage/' . $existingHero) : null;
                    @endphp

                    <img id="ev_hero_image_preview"
                         src="{{ $heroUrl ?? '' }}"
                         alt=""
                         class="w-full h-full object-cover {{ $heroUrl ? '' : 'hidden' }}"
                         onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');">

                    <div id="ev_hero_image_placeholder"
                         class="text-center text-slate-400 {{ $heroUrl ? 'hidden' : '' }}">
                        <i class="fa-regular fa-image text-3xl mb-2"></i>
                        <p class="text-[11px] font-semibold">No image</p>
                    </div>
                </div>

                {{-- File upload button --}}
                <label for="ev_hero_image_file"
                       class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-lg
                              bg-brandPink text-white text-sm font-semibold cursor-pointer
                              hover:bg-pink-700 transition shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Choose File</span>
                    <input id="ev_hero_image_file" name="hero_image" type="file" accept="image/*"
                           class="hidden" onchange="previewImage(this, 'ev_hero_image_preview', 'ev_hero_image_placeholder')">
                </label>

                {{-- Filename --}}
                <p id="ev_hero_image_filename" class="text-[11px] text-slate-500 text-center truncate"></p>

                @if($existingHero)
                    <p class="text-[10px] text-slate-400 text-center truncate font-mono" title="{{ $existingHero }}">
                        Current: {{ $existingHero }}
                    </p>
                @endif

                {{-- Manual path fallback --}}
                <details class="text-[11px]">
                    <summary class="cursor-pointer text-slate-500 hover:text-brandPink font-semibold">
                        <i class="fa-solid fa-link mr-1"></i> Or use manual path
                    </summary>
                    <input type="text" name="hero_image_path"
                           value="{{ old('hero_image_path', ($existingHero && !$heroIsStorage) ? $existingHero : '') }}"
                           placeholder="img/event2.png"
                           class="mt-2 w-full px-3 py-1.5 border border-slate-200 rounded text-xs
                                  focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                </details>

            </div>
        </div>

    </div>
</div>

{{-- =================== RACE CATEGORIES =================== --}}
<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <h3 class="text-sm font-extrabold text-slate-800">
            <i class="fa-solid fa-list text-brandPink mr-1"></i> Race Categories
            <span class="text-[10px] text-slate-400 font-normal">(unlimited)</span>
        </h3>
        <button type="button" onclick="addCategoryRow()"
                class="px-3 py-1.5 bg-brandPink text-white rounded text-xs font-bold hover:bg-pink-700 transition">
            <i class="fa-solid fa-plus"></i> Add Category
        </button>
    </div>

    <div id="categoriesContainer" class="space-y-3"></div>
</div>

{{-- =================== ENTITLEMENTS =================== --}}
<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <h3 class="text-sm font-extrabold text-slate-800">
            <i class="fa-solid fa-gift text-brandPink mr-1"></i> Runner Entitlements
        </h3>
        <button type="button" onclick="addEntitlementRow()"
                class="px-3 py-1.5 bg-brandPink text-white rounded text-xs font-bold hover:bg-pink-700 transition">
            <i class="fa-solid fa-plus"></i> Add Entitlement
        </button>
    </div>

    <div id="entitlementsContainer" class="space-y-2"></div>
</div>

{{-- =================== AWARDS =================== --}}
<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <h3 class="text-sm font-extrabold text-slate-800 mb-4 pb-3 border-b border-slate-100">
        <i class="fa-solid fa-trophy text-brandPink mr-1"></i> Awards & Recognition
    </h3>

    <div class="space-y-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Award Intro</label>
            <textarea name="awards_intro" rows="2"
                      placeholder="Top three finishers will be awarded prize money as below."
                      class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                             focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">{{ old('awards_intro', $awards['intro'] ?? '') }}</textarea>
        </div>

        <div>
            <div class="flex items-center justify-between mb-3">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-600">Positions & Amounts</label>
                <button type="button" onclick="addAwardRow()"
                        class="px-3 py-1.5 bg-brandPink text-white rounded text-xs font-bold hover:bg-pink-700 transition">
                    <i class="fa-solid fa-plus"></i> Add Position
                </button>
            </div>
            <div id="awardsContainer" class="space-y-2"></div>
            <p class="text-[10px] text-slate-400 mt-2">
                <i class="fa-solid fa-info-circle"></i>
                Amount fields correspond to category positions (Cat 1, Cat 2, ...).
            </p>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Award Notes</label>
            <textarea name="awards_notes" rows="2"
                      placeholder="Podium positions will be determined based on Gun Time."
                      class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                             focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">{{ old('awards_notes', $awards['notes'] ?? '') }}</textarea>
        </div>
    </div>
</div>

{{-- =================== SCHEDULES =================== --}}
<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <h3 class="text-sm font-extrabold text-slate-800">
            <i class="fa-solid fa-clock text-brandPink mr-1"></i> Race Day Schedule
        </h3>
        <button type="button" onclick="addScheduleRow()"
                class="px-3 py-1.5 bg-brandPink text-white rounded text-xs font-bold hover:bg-pink-700 transition">
            <i class="fa-solid fa-plus"></i> Add Schedule
        </button>
    </div>

    <div id="schedulesContainer" class="space-y-2"></div>
    <p class="text-[10px] text-slate-400 mt-2">
        <i class="fa-solid fa-info-circle"></i> If empty, "TBA" will display on frontend.
    </p>
</div>

{{-- =================== RULES =================== --}}
<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5 mb-5">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <h3 class="text-sm font-extrabold text-slate-800">
            <i class="fa-solid fa-clipboard-list text-brandPink mr-1"></i> Rules & Guidelines
        </h3>
        <button type="button" onclick="addRuleRow()"
                class="px-3 py-1.5 bg-brandPink text-white rounded text-xs font-bold hover:bg-pink-700 transition">
            <i class="fa-solid fa-plus"></i> Add Rule
        </button>
    </div>

    <div id="rulesContainer" class="space-y-2"></div>
</div>

{{-- =================== HIDDEN JSON INPUTS =================== --}}
<input type="hidden" name="categories"   id="ev_categories_json">
<input type="hidden" name="entitlements" id="ev_entitlements_json">
<input type="hidden" name="awards"       id="ev_awards_json">
<input type="hidden" name="schedules"    id="ev_schedules_json">
<input type="hidden" name="rules"        id="ev_rules_json">

{{-- =================== SCRIPT =================== --}}
<script>
(function () {
    'use strict';

    const initial = {
        categories:   @json($categories),
        entitlements: @json($entitlements),
        awards:       @json($awards),
        schedules:    @json($schedules),
        rules:        @json($rules),
    };

    /* ============ ESCAPE ============ */
    function esc(v) {
        if (v == null) return '';
        return String(v)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    /* ============ IMAGE PREVIEW ============ */
    window.previewImage = function (input, previewId, placeholderId) {
        const preview = document.getElementById(previewId);
        const placeholder = placeholderId ? document.getElementById(placeholderId) : null;

        if (!preview || !input.files || !input.files[0]) return;

        const file = input.files[0];

        // Show filename
        const filenameEl = document.getElementById(input.id.replace('_file', '_filename'));
        if (filenameEl) {
            filenameEl.textContent = '✓ ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
            filenameEl.className = 'text-[11px] text-green-600 text-center truncate font-semibold';
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    };

    /* ============ CATEGORY ============ */
    window.addCategoryRow = function (data = {}) {
        const html = `
            <div class="category-row grid grid-cols-1 md:grid-cols-6 gap-2 p-3 bg-slate-50 border border-slate-200 rounded-lg relative">
                <input type="text" data-key="distance" value="${esc(data.distance)}" placeholder="Distance (21.1K)" class="md:col-span-1 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-key="name" value="${esc(data.name)}" placeholder="Name (BEYOND)" class="md:col-span-1 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-key="cutoff" value="${esc(data.cutoff)}" placeholder="Cut-off time" class="md:col-span-1 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="number" step="0.01" data-key="fee" value="${esc(data.fee)}" placeholder="Fee" class="md:col-span-1 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-key="tagline" value="${esc(data.tagline)}" placeholder="Tagline" class="md:col-span-2 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <textarea data-key="description" placeholder="Description" rows="2" class="md:col-span-6 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">${esc(data.description)}</textarea>
                <button type="button" onclick="this.closest('.category-row').remove()"
                        class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full text-xs shadow-md hover:bg-red-600 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>`;
        document.getElementById('categoriesContainer').insertAdjacentHTML('beforeend', html);
    };

    /* ============ ENTITLEMENT ============ */
    window.addEntitlementRow = function (data = {}) {
        const html = `
            <div class="entitlement-row grid grid-cols-7 gap-2 p-2 bg-slate-50 border border-slate-200 rounded-lg relative">
                <input type="text" data-key="icon" value="${esc(data.icon)}" placeholder="👕" class="col-span-1 px-2 py-1.5 border rounded text-xs text-center focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-key="text" value="${esc(data.text)}" placeholder="Item description" class="col-span-6 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <button type="button" onclick="this.closest('.entitlement-row').remove()"
                        class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full text-xs shadow-md hover:bg-red-600 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>`;
        document.getElementById('entitlementsContainer').insertAdjacentHTML('beforeend', html);
    };

    /* ============ AWARD ============ */
    window.addAwardRow = function (data = {}) {
        const amounts = Array.isArray(data.amounts) ? data.amounts : [];
        const html = `
            <div class="award-row grid grid-cols-2 md:grid-cols-6 gap-2 p-2 bg-slate-50 border border-slate-200 rounded-lg relative">
                <input type="text" data-key="label" value="${esc(data.label)}" placeholder="Position (Champion)" class="col-span-2 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-amount="0" value="${esc(amounts[0])}" placeholder="Cat 1" class="px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-amount="1" value="${esc(amounts[1])}" placeholder="Cat 2" class="px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-amount="2" value="${esc(amounts[2])}" placeholder="Cat 3" class="px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-amount="3" value="${esc(amounts[3])}" placeholder="Cat 4" class="px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <button type="button" onclick="this.closest('.award-row').remove()"
                        class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full text-xs shadow-md hover:bg-red-600 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>`;
        document.getElementById('awardsContainer').insertAdjacentHTML('beforeend', html);
    };

    /* ============ SCHEDULE ============ */
    window.addScheduleRow = function (data = {}) {
        const html = `
            <div class="schedule-row grid grid-cols-1 md:grid-cols-4 gap-2 p-2 bg-slate-50 border border-slate-200 rounded-lg relative">
                <input type="text" data-key="time" value="${esc(data.time)}" placeholder="07:00 AM" class="px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-key="title" value="${esc(data.title)}" placeholder="Activity" class="md:col-span-2 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <input type="text" data-key="note" value="${esc(data.note)}" placeholder="Note" class="px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">
                <button type="button" onclick="this.closest('.schedule-row').remove()"
                        class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full text-xs shadow-md hover:bg-red-600 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>`;
        document.getElementById('schedulesContainer').insertAdjacentHTML('beforeend', html);
    };

    /* ============ RULE ============ */
    window.addRuleRow = function (text = '') {
        const html = `
            <div class="rule-row flex gap-2 p-2 bg-slate-50 border border-slate-200 rounded-lg relative">
                <span class="rule-number w-7 h-7 rounded-full bg-brandPink text-white text-xs font-bold flex items-center justify-center flex-shrink-0"></span>
                <textarea data-key="text" rows="2" placeholder="Rule text" class="flex-1 px-2 py-1.5 border rounded text-xs focus:ring-2 focus:ring-brandPink focus:outline-none">${esc(text)}</textarea>
                <button type="button" onclick="this.closest('.rule-row').remove(); renumberRules();"
                        class="w-7 h-7 self-start bg-red-500 text-white rounded-full text-xs shadow-md hover:bg-red-600 transition flex-shrink-0">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>`;
        document.getElementById('rulesContainer').insertAdjacentHTML('beforeend', html);
        renumberRules();
    };

    window.renumberRules = function () {
        document.querySelectorAll('#rulesContainer .rule-row').forEach((row, i) => {
            const num = row.querySelector('.rule-number');
            if (num) num.textContent = i + 1;
        });
    };

    /* ============ INIT ============ */
    function initialize() {
        ['categoriesContainer','entitlementsContainer','awardsContainer','schedulesContainer','rulesContainer']
            .forEach(id => { const el = document.getElementById(id); if (el) el.innerHTML = ''; });

        (initial.categories   || []).forEach(c => window.addCategoryRow(c));
        (initial.entitlements || []).forEach(e => window.addEntitlementRow(e));
        if (initial.awards && Array.isArray(initial.awards.positions)) {
            initial.awards.positions.forEach(p => window.addAwardRow(p));
        }
        (initial.schedules || []).forEach(s => window.addScheduleRow(s));
        (initial.rules     || []).forEach(r => { if (typeof r === 'string') window.addRuleRow(r); });

        window.renumberRules();
    }

    /* ============ SUBMIT COLLECT ============ */
    function attachSubmitHandler() {
        const form = document.getElementById('eventForm');
        if (!form) return;

        form.addEventListener('submit', function () {
            // Categories
            const categories = [];
            document.querySelectorAll('#categoriesContainer .category-row').forEach(row => {
                const c = {};
                row.querySelectorAll('[data-key]').forEach(el => c[el.dataset.key] = el.value.trim());
                if (c.distance || c.name) categories.push(c);
            });
            document.getElementById('ev_categories_json').value = JSON.stringify(categories);

            // Entitlements
            const entitlements = [];
            document.querySelectorAll('#entitlementsContainer .entitlement-row').forEach(row => {
                const e = {};
                row.querySelectorAll('[data-key]').forEach(el => e[el.dataset.key] = el.value.trim());
                if (e.text) entitlements.push(e);
            });
            document.getElementById('ev_entitlements_json').value = JSON.stringify(entitlements);

            // Awards
            const positions = [];
            document.querySelectorAll('#awardsContainer .award-row').forEach(row => {
                const p = { label: '', amounts: [] };
                row.querySelectorAll('[data-key]').forEach(el => p[el.dataset.key] = el.value.trim());
                row.querySelectorAll('[data-amount]').forEach(el => {
                    p.amounts[parseInt(el.dataset.amount)] = el.value.trim();
                });
                if (p.label) positions.push(p);
            });
            const introEl = document.querySelector('[name="awards_intro"]');
            const notesEl = document.querySelector('[name="awards_notes"]');
            const awards = {
                intro:     introEl ? introEl.value.trim() : '',
                positions: positions,
                notes:     notesEl ? notesEl.value.trim() : '',
            };
            document.getElementById('ev_awards_json').value = JSON.stringify(awards);

            // Schedules
            const schedules = [];
            document.querySelectorAll('#schedulesContainer .schedule-row').forEach(row => {
                const s = {};
                row.querySelectorAll('[data-key]').forEach(el => s[el.dataset.key] = el.value.trim());
                if (s.title || s.time) schedules.push(s);
            });
            document.getElementById('ev_schedules_json').value = JSON.stringify(schedules);

            // Rules
            const rules = [];
            document.querySelectorAll('#rulesContainer .rule-row').forEach(row => {
                const ta = row.querySelector('[data-key="text"]');
                if (ta && ta.value.trim()) rules.push(ta.value.trim());
            });
            document.getElementById('ev_rules_json').value = JSON.stringify(rules);
        });
    }

    /* ============ BOOT ============ */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initialize();
            attachSubmitHandler();
        });
    } else {
        initialize();
        attachSubmitHandler();
    }
})();


</script>

{{-- =================== SUMMERNOTE JS =================== --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
(function () {
    'use strict';

    function initSummernote() {
        const editorEl = document.getElementById('summernote-editor');
        const hiddenTextarea = document.getElementById('ev_description');

        if (!editorEl || !hiddenTextarea) return;

        // Check if jQuery is available
        if (typeof jQuery === 'undefined') {
            console.error('Summernote: jQuery not loaded');
            return;
        }

        // Destroy existing instance (if re-initialized)
        if (jQuery('#summernote-editor').next('.note-editor').length) {
            jQuery('#summernote-editor').summernote('destroy');
        }

        // Initialize Summernote
        jQuery('#summernote-editor').summernote({
            height: 320,
            minHeight: 200,
            maxHeight: 600,
            focus: false,

            placeholder: 'Write event description here...\n\nYou can use bold, italic, lists, headings, links, and images.',

            toolbar: [
                ['style',    ['style']],
                ['font',     ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fontsize', ['fontsize']],
                ['color',    ['color']],
                ['para',     ['ul', 'ol', 'paragraph']],
                ['height',   ['height']],
                ['table',    ['table']],
                ['insert',   ['link', 'picture', 'video', 'hr']],
                ['view',     ['fullscreen', 'codeview', 'help']],
            ],

            styleTags: [
                'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre'
            ],

            fontNames: ['Arial', 'Inter', 'Helvetica', 'Georgia', 'Times New Roman', 'Courier New'],
            fontSizes: ['10', '11', '12', '13', '14', '15', '16', '18', '20', '22', '24', '28', '32'],

            // Set initial value
            callbacks: {
                onInit: function () {
                    const initialValue = hiddenTextarea.value || '';
                    if (initialValue.trim()) {
                        jQuery('#summernote-editor').summernote('code', initialValue);
                    }
                },

                // Sync content to hidden textarea on any change
                onChange: function (contents) {
                    hiddenTextarea.value = contents;
                },

                // Also sync on blur (safety)
                onBlur: function () {
                    const contents = jQuery('#summernote-editor').summernote('code');
                    hiddenTextarea.value = contents;
                },

                // Paste as plain text (avoid weird formatting)
                onPaste: function (e) {
                    // Allow default paste — but strip styles if needed
                },

                // Image upload handler (base64 → inline)
                onImageUpload: function (files) {
                    for (let i = 0; i < files.length; i++) {
                        uploadImage(files[i]);
                    }
                },
            },
        });

        // Attach form submit handler to sync content
        const form = document.getElementById('eventForm');
        if (form && !form._summernoteHandler) {
            form._summernoteHandler = true;
            form.addEventListener('submit', function () {
                const contents = jQuery('#summernote-editor').summernote('code');
                hiddenTextarea.value = contents;
            });
        }

        // Custom image upload (base64 inline)
        function uploadImage(file) {
            if (!file || !file.type.startsWith('image/')) return;
            if (file.size > 2 * 1024 * 1024) {
                alert('Image must be under 2 MB');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                jQuery('#summernote-editor').summernote('insertImage', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    }

    // Wait for jQuery + Summernote to load
    function boot() {
        if (typeof jQuery === 'undefined' || typeof jQuery.fn.summernote === 'undefined') {
            // Retry once after 100ms
            setTimeout(boot, 100);
            return;
        }
        initSummernote();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
</script>