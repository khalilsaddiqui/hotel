<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Hotel;
class HotelTest extends TestCase
{
    public function testCreateHotel()
    {
        $response = $this->postJson('/api/hotels', [
            'name' => 'Test Hotel',
            'country_code' => 'US',
            'city' => 'New York',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Test Hotel',
                 ]);
    }

    // Add more tests for update, delete, and read operations
}
