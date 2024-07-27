<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Room;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $hotel = Hotel::create([
        'name' => 'Grand Hotel',
        'country_code' => 'US',
        'city' => 'New York',
    ]);

    Room::create([
        'hotel_id' => $hotel->id,
        'room_type' => 'Deluxe Room',
        'price' => 250.00,
    ]);

    $hotel = Hotel::create([
        'name' => 'Beach Resort',
        'country_code' => 'AU',
        'city' => 'Sydney',
    ]);

    Room::create([
        'hotel_id' => $hotel->id,
        'room_type' => 'Ocean View Room',
        'price' => 300.00,
    ]);
    $hotel = Hotel::create([
        'name' => 'Mountain Lodge',
        'country_code' => 'CA',
        'city' => 'Banff',
    ]);

    Room::create([
        'hotel_id' => $hotel->id,
        'room_type' => 'Standard Room',
        'price' => 200.00,
    ]);
    
}
}
