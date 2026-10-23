<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'first_name', 'last_name', 'email', 'phone',
        'gender', 'dob', 'nid', 'address',
        'emergency_name', 'emergency_phone',
        'category', 'tshirt_size', 'amount',
        'payment_method', 'trx_id', 'sender_phone_last3',
        'status', 'admin_note',
        'profile_image',
        'bib_number',
        'blood_group',
        'whatsapp_number',     // ← add this
        'attended',
        'start_time',
        'end_time',
        'time_taken',
    ];
    protected $casts = [
        'dob' => 'date',
        'amount' => 'decimal:2',
        'attended'   => 'boolean',
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
    ];

    protected static function booted(): void
    {
        static::saving(function (Registration $reg) {
            if ($reg->start_time && $reg->end_time) {
                $start = \Carbon\Carbon::parse($reg->start_time);
                $end   = \Carbon\Carbon::parse($reg->end_time);

                if ($end->lessThan($start)) {
                    $end->addDay(); // cross-midnight
                }

                $diff = $start->diff($end);
                $reg->time_taken = sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s);
            } else {
                $reg->time_taken = null;
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
