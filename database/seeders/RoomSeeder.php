<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        // Example room data, associating rooms with hotels
        Room::create([
            'hotel_id' => 1, // Assuming this is the ID for 'Grand Hotel'
            'room_type' => 'Deluxe Room',
            'price' => 250.00,
        ]);

        Room::create([
            'hotel_id' => 1, // Assuming this is the ID for 'Grand Hotel'
            'room_type' => 'Executive Suite',
            'price' => 400.00,
        ]);

        Room::create([
            'hotel_id' => 2, // Assuming this is the ID for 'Beach Resort'
            'room_type' => 'Ocean View Room',
            'price' => 300.00,
        ]);

        Room::create([
            'hotel_id' => 3, // Assuming this is the ID for 'Mountain Lodge'
            'room_type' => 'Standard Room',
            'price' => 200.00,
        ]);
    }
}