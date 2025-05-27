<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function EventPage()
    {
        return view('event');
    }
    
    /**
     * Store a new event booking in the database.
     *
     * @param  \Illuminate\Http\Request  $request   
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'eventType' => 'required|string',
            'eventDate' => 'required|date|after_or_equal:today',
            'guestCount' => 'required|integer|min:1',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|string|max:20',
            'specialRequests' => 'nullable|string',
            'terms_agreement' => 'required|accepted',
        ]);
        
        // Calculate base price based on event type and guest count
        $basePrice = $this->calculateEventPrice($validated['eventType'], $validated['guestCount']);
        
        // Create booking
        $booking = EventBooking::create([
            'booking_id' => EventBooking::generateBookingId(),
            'event_type' => $validated['eventType'],
            'event_date' => $validated['eventDate'],
            'guest_count' => $validated['guestCount'],
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'phone_number' => $validated['phoneNumber'],
            'special_requests' => $validated['specialRequests'],
            'base_price' => $basePrice,
            'total_price' => $basePrice, // Can be modified later for add-ons
            'status' => 'pending',
        ]);
        
        // For future implementation: Send confirmation email
        // Mail::to($booking->email)->send(new EventBookingConfirmation($booking));
        
        // Return JSON response for AJAX handling
        return response()->json([
            'success' => true,
            'message' => 'Event booking created successfully',
            'booking' => [
                'id' => $booking->booking_id,
                'eventType' => $booking->event_type,
                'eventDate' => $booking->event_date->format('F j, Y'),
                'guestCount' => $booking->guest_count,
            ]
        ]);
    }
    
    /**
     * Calculate the event price based on event type and number of guests.
     *
     * @param  string  $eventType
     * @param  int  $guestCount
     * @return float
     */
    private function calculateEventPrice($eventType, $guestCount)
    {
        $basePrices = [
            'wedding' => 75000,
            'birthday' => 25000,
            'corporate' => 35000,
            'reunion' => 40000,
            'other' => 30000,
        ];
        
        // Get base price for event type
        $price = $basePrices[$eventType] ?? 30000;
        
        return $price;
    }
}
