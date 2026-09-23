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
        'profile_image',        // ← add this
    ];
    protected $casts = [
        'dob' => 'date',
        'amount' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}