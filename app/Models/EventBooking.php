<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'booking_id',
        'event_type',
        'event_date',
        'guest_count',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'special_requests',
        'base_price',
        'total_price',
        'status'
    ];
    
    protected $casts = [
        'event_date' => 'date',
    ];
    
    /**
     * Generate a unique booking ID for events
     * 
     * @return string
     */
    public static function generateBookingId(): string
    {
        $prefix = 'EVT';
        $dateCode = date('Ymd');
        $randomCode = strtoupper(substr(uniqid(), -5));
        
        return $prefix . $dateCode . $randomCode;
    }
}
