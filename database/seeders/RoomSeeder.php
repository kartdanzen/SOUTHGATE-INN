<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Deluxe Room',
                'type' => 'deluxe',
                'price_per_night' => 2499.00,
                'description' => 'Spacious and elegant room with modern amenities and stunning views, perfect for a relaxing stay.',
                'image' => 'rooms/DELUXE ROOM.jpg',
                'features' => json_encode([
                    ['icon' => 'bed', 'text' => 'King Bed'],
                    ['icon' => 'wifi', 'text' => 'Free WiFi'],
                    ['icon' => 'snowflake', 'text' => 'AC'],
                    ['icon' => 'city', 'text' => 'City View']
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Family Suite',
                'type' => 'family',
                'price_per_night' => 3100.00,
                'description' => 'Comfortable suite designed for families with separate living area and all the amenities you need.',
                'image' => 'rooms/featured room.jpg',
                'features' => json_encode([
                    ['icon' => 'bed', 'text' => '2 Queen Beds'],
                    ['icon' => 'wifi', 'text' => 'Free WiFi'],
                    ['icon' => 'bath', 'text' => 'Bathtub'],
                    ['icon' => 'tv', 'text' => 'Smart TV']
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Executive Suite',
                'type' => 'executive',
                'price_per_night' => 3100.00,
                'description' => 'Luxurious suite with premium furnishings, panoramic views, and exclusive amenities for discerning guests.',
                'image' => 'rooms/room1.jpg',
                'features' => json_encode([
                    ['icon' => 'bed', 'text' => 'King Bed'],
                    ['icon' => 'bath', 'text' => 'Jacuzzi'],
                    ['icon' => 'utensils', 'text' => 'Mini Bar'],
                    ['icon' => 'concierge-bell', 'text' => 'Room Service']
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 