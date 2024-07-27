<?php

namespace Tests\Unit;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_hotel()
    {
        $data = [
            'name' => 'Grand Hotel',
            'country_code' => 'US',
            'city' => 'New York',
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/hotels', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('hotels', $data);
    }

    /** @test */
    public function it_can_update_a_hotel()
    {
        $hotel = Hotel::factory()->create();

        $data = [
            'name' => 'Updated Hotel',
            'country_code' => 'US',
            'city' => 'Los Angeles',
        ];

        $response = $this->putJson("http://127.0.0.1:8000/api/hotels/{$hotel->id}", $data);
        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('hotels', $data);
    }

    /** @test */
    public function it_can_delete_a_hotel()
    {
        $hotel = Hotel::factory()->create();

        $response = $this->deleteJson("http://127.0.0.1:8000/api/hotels/{$hotel->id}");
        $response->assertStatus(204);

        $this->assertDatabaseMissing('hotels', ['id' => $hotel->id]);
    }

    /** @test */
    public function it_can_list_hotels()
    {
        $hotels = Hotel::factory()->count(3)->create();

        $response = $this->getJson('http://127.0.0.1:8000/api/hotels');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_show_a_hotel()
    {
        $hotel = Hotel::factory()->create();

        $response = $this->getJson("http://127.0.0.1:8000/api/hotels/{$hotel->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $hotel->id]);
    }
}
