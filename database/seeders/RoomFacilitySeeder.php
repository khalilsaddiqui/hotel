<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomFacility;

class RoomFacilitySeeder extends Seeder
{
    public function run()
    {
        RoomFacility::create([
            'room_id' => 1, // Assuming this is the ID for a specific room
            'facility' => 'Free Wi-Fi',
        ]);

        RoomFacility::create([
            'room_id' => 1,
            'facility' => 'Air Conditioning',
        ]);

        RoomFacility::create([
            'room_id' => 2,
            'facility' => 'Room Service',
        ]);

        // Add more facilities as needed
    }
}
