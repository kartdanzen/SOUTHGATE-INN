<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'guest_first_name',
        'guest_last_name',
        'guest_email',
        'guest_phone',
        'room_type',
        'room_price',
        'total_price',
        'check_in',
        'check_out',
        'special_requests'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date'
    ];
}
