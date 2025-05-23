<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Wedding Celebrations',
                'type' => 'wedding',
                'description' => 'Create timeless memories on your special day with our elegant ballroom and customized wedding packages.',
                'image' => 'images/wedding.jpg',
                'meta' => json_encode([
                    'guests' => 'Up to 300 guests',
                    'venue' => 'Grand Ballroom'
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Corporate Events',
                'type' => 'corporate',
                'description' => 'Professional meeting spaces equipped with modern technology for conferences, seminars, and business gatherings.',
                'image' => 'images/corporate.jpg',
                'meta' => json_encode([
                    'guests' => '20-150 guests',
                    'venue' => 'Executive Conference Center'
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Birthday Celebrations',
                'type' => 'birthday',
                'description' => 'Make your birthday unforgettable with our specially designed celebration packages and festive venues.',
                'image' => 'images/birthday.jpg',
                'meta' => json_encode([
                    'guests' => '30-150 guests',
                    'venue' => 'Crystal Hall'
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Family Reunions',
                'type' => 'reunion',
                'description' => 'Reconnect with loved ones in our warm and inviting spaces perfect for family gatherings and reunions.',
                'image' => 'images/reunion.jpg',
                'meta' => json_encode([
                    'guests' => '20-100 guests',
                    'venue' => 'Garden Pavilion'
                ]),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 