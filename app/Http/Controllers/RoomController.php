<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Booking;

class RoomController extends Controller
{
    public function RoomPage(Request $request)
    {
        // Get URL parameters for room booking
        $roomType = $request->query('roomType');
        $checkIn = $request->query('checkIn');
        $checkOut = $request->query('checkOut');
        $nightlyPrice = $request->query('nightlyPrice');
        $totalPrice = $request->query('totalPrice');
        $duration = $request->query('duration');
        $autoOpen = $request->query('autoOpen');

        // Use nightly price if available, otherwise default value
        $price = $nightlyPrice ?: ($request->query('price') ?: '2500');

        // Pass these parameters to the view
        return view('room', [
            'roomType' => $roomType,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'price' => $price,
            'totalPrice' => $totalPrice,
            'duration' => $duration,
            'autoOpen' => $autoOpen,
        ]);
    }

    public function storeBooking(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'guest_first_name' => 'required|string|max:255',
            'guest_last_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'room_type' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'special_requests' => 'nullable|string',
            'terms_agreement' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Generate a unique booking ID
        $bookingId = 'SGI-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        try {
            // Create the booking
            $booking = Booking::create([
                'booking_id' => $bookingId,
                'guest_first_name' => $request->guest_first_name,
                'guest_last_name' => $request->guest_last_name,
                'guest_email' => $request->guest_email,
                'guest_phone' => $request->guest_phone,
                'room_type' => $request->room_type,
                'room_price' => $request->room_price,
                'total_price' => $request->total_price,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'special_requests' => $request->special_requests
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Booking successful',
                'booking_id' => $bookingId,
                'booking_details' => [
                    'room_type' => $booking->room_type,
                    'check_in' => $booking->check_in->format('F j, Y'),
                    'check_out' => $booking->check_out->format('F j, Y'),
                    'price' => '₱' . number_format($booking->room_price, 2),
                    'total' => '₱' . number_format($booking->total_price, 2),
                    'guest_name' => $booking->guest_first_name . ' ' . $booking->guest_last_name,
                    'guest_email' => $booking->guest_email,
                    'guest_phone' => $booking->guest_phone
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating booking: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkAvailability(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Updated to include all 6 rooms from the JavaScript file
        $availableRooms = [
            [
                'name' => 'Deluxe Room',
                'price' => '₱2,400',
                'image' => asset('rooms/DELUXE ROOM.jpg'),
                'features' => ['1 King Bed', 'Free High-Speed WiFi', 'Air Conditioning', 'City View']
            ],
            [
                'name' => 'Family Deluxe',
                'price' => '₱2,500',
                'image' => asset('rooms/featured room.jpg'),
                'features' => ['1 Queen Bed + 2 Twin Beds', 'Free High-Speed WiFi', 'Air Conditioning', 'Separate Living Area']
            ],
            [
                'name' => 'Standard Room',
                'price' => '₱1,900',
                'image' => asset('rooms/featured room.jpg'),
                'features' => ['1 Queen Bed + 2 Twin Beds', 'Free High-Speed WiFi', 'Air Conditioning', 'Garden View']
            ],
            [
                'name' => 'Suite Room',
                'price' => '₱3,100',
                'image' => asset('rooms/room1.jpg'),
                'features' => ['1 King Bed', 'Premium WiFi', 'Luxury Bathroom', 'Panoramic City View']
            ],
            [
                'name' => 'Superior Room',
                'price' => '₱2,700',
                'image' => asset('rooms/room3.jpg'),
                'features' => ['1 Queen Bed', 'Free High-Speed WiFi', 'Bathtub', 'City View']
            ],
            [
                'name' => 'Single Room',
                'price' => '₱1,700',
                'image' => asset('rooms/room4.jpg'),
                'features' => ['1 Single Bed', 'Free WiFi', 'Air Conditioning', 'Private Bathroom']
            ]
        ];

        return response()->json([
            'status' => 'success',
            'available_rooms' => $availableRooms,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out
        ]);
    }
}
