<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'location', 'event_date', 'start_time',
        'category', 'fee', 'slots', 'registered', 'status',
        'image', 'description',
    ];

    protected $casts = [
        'event_date' => 'date',
        'fee' => 'decimal:2',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}