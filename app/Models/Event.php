<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'presented_by', 'tagline', 'slug',
        'location', 'event_date', 'start_time',
        'category', 'fee', 'slots', 'registered', 'status',
        'image', 'hero_image', 'description',
        'race_type', 'organizer', 'is_featured',
        'categories', 'entitlements', 'awards', 'schedules', 'rules',
    ];

    protected $casts = [
        'event_date'   => 'date',
        'fee'          => 'decimal:2',
        'is_featured'  => 'boolean',
        'categories'   => 'array',
        'entitlements' => 'array',
        'awards'       => 'array',
        'schedules'    => 'array',
        'rules'        => 'array',
    ];

    protected $attributes = [
        'status'      => 'draft',
        'race_type'   => 'Live Road Race',
        'is_featured' => false,
        'registered'  => 0,
    ];

    /**
     * ✅ Accessors to include in JSON serialization.
     */
    protected $appends = [
        'image_url',
        'hero_image_url',
    ];

    // ========================================
    // DEFAULT TEMPLATE
    // ========================================
    public static function getDefaultTemplate(): array
    {
        return [
            'subtitle'     => 'Second Edition',
            'presented_by' => 'Run BURJOWAN Proudly Presents',
            'tagline'      => "More Than a Race, It's a Movement.",
            'race_type'    => 'Live Road Race',
            'organizer'    => 'Run BURJOWAN',

            'categories' => [
                [
                    'distance'    => '21.1K',
                    'name'        => 'BEYOND',
                    'tagline'     => 'Where Grit Meets Glory.',
                    'description' => 'Practice the half marathon and take on the next level of endurance. Designed for runners ready to push their limits, test their resilience, and earn every kilometre.',
                    'cutoff'      => '3 Hours 30 Minutes',
                    'fee'         => 1500,
                ],
                [
                    'distance'    => '15K',
                    'name'        => 'BLAST',
                    'tagline'     => 'Where Speed Meets Stamina.',
                    'description' => 'A perfect balance of distance, pace, and performance — ideal for runners looking for a focused and rewarding challenge.',
                    'cutoff'      => '2 Hours 30 Minutes',
                    'fee'         => 1000,
                ],
                [
                    'distance'    => '7.5K',
                    'name'        => 'BOLT',
                    'tagline'     => 'Chase It. Conquer It.',
                    'description' => 'A welcoming distance for new runners and experienced participants alike. Run, jog, or walk — this is your opportunity to be part of the race.',
                    'cutoff'      => '90 Minutes',
                    'fee'         => 500,
                ],
            ],

            'entitlements' => [
                ['icon' => '👕', 'text' => "Run BURJOWAN\nRace T-Shirt"],
                ['icon' => '🎟️', 'text' => 'Race BIB'],
                ['icon' => '🏅', 'text' => "Imported\nMedal"],
                ['icon' => '🙏', 'text' => "Dedicated\nPrayer Zone"],
                ['icon' => '💧', 'text' => "On-Course Hydration\nand Support"],
                ['icon' => '✚',  'text' => "Medical and First\nAid Support"],
                ['icon' => '🥤', 'text' => "Post-Race\nRefreshment Pack"],
                ['icon' => '📜', 'text' => "Digital Finisher\nCertificate"],
            ],

            'awards' => [
                'intro' => "BEYOND (21.1K), BLAST (15K) and BOLT (7.5K)\nTop three finishers will be awarded prize money as below.",
                'positions' => [
                    ['label' => 'Champion',      'amounts' => ['4,000', '3,000', '2,000']],
                    ['label' => '1st Runner Up', 'amounts' => ['3,000', '2,000', '1,000']],
                    ['label' => '2nd Runner Up', 'amounts' => ['2,000', '1,000', '500']],
                ],
                'notes' => 'Podium positions will be determined based on Gun Time.',
            ],

            'schedules' => [
                ['time' => '06:00 AM', 'title' => 'Reporting & BIB Collection', 'note' => ''],
                ['time' => '07:00 AM', 'title' => 'Warm-up Session',             'note' => ''],
                ['time' => '07:30 AM', 'title' => '21.1K Flag Off',              'note' => ''],
                ['time' => '07:45 AM', 'title' => '15K Flag Off',                'note' => ''],
                ['time' => '08:00 AM', 'title' => '7.5K Flag Off',               'note' => ''],
            ],

            'rules' => [
                'Pre-registration is mandatory. No on-spot registration will be permitted.',
                'BIBs are strictly non-transferable. Running under another participant\'s BIB will result in disqualification.',
                'Medals will be awarded only to participants who complete their respective races within the official cut-off time.',
                'No refunds or category changes will be permitted once registration is confirmed.',
                'Organizers reserve the right to modify the race schedule, course, or event logistics in case of adverse weather conditions or safety concerns.',
            ],
        ];
    }

    // ========================================
    // RELATIONS
    // ========================================
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // ========================================
    // ACCESSORS
    // ========================================
    public function getCategoriesCountAttribute(): int
    {
        return is_array($this->categories) ? count($this->categories) : 0;
    }

    /**
     * Get full URL for main image.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('img/placeholder.png');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'events/')) {
            return asset('storage/' . $this->image);
        }

        return asset($this->image);
    }

    /**
     * Get full URL for hero image.
     */
    public function getHeroImageUrlAttribute(): string
    {
        if (empty($this->hero_image)) {
            return asset('img/event2.png');
        }

        if (Str::startsWith($this->hero_image, ['http://', 'https://'])) {
            return $this->hero_image;
        }

        if (Str::startsWith($this->hero_image, 'events/')) {
            return asset('storage/' . $this->hero_image);
        }

        return asset($this->hero_image);
    }
}