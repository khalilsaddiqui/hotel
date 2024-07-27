<?php

namespace Tests\Unit;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_room()
    {
        $hotel = Hotel::factory()->create();

        $data = [
            'hotel_id' => $hotel->id,
            'room_type' => 'Deluxe',
            'price' => 250,
        ];

        $response = $this->postJson('/api/rooms', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('rooms', $data);
    }

    /** @test */
    public function it_can_update_a_room()
    {
        $room = Room::factory()->create();

        $data = [
            'room_type' => 'Updated Room',
            'price' => 300,
        ];

        $response = $this->putJson("/api/rooms/{$room->id}", $data);
        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('rooms', $data);
    }

    /** @test */
    public function it_can_delete_a_room()
    {
        $room = Room::factory()->create();

        $response = $this->deleteJson("/api/rooms/{$room->id}");
        $response->assertStatus(204);

        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }

    /** @test */
    public function it_can_list_rooms()
    {
        $rooms = Room::factory()->count(3)->create();

        $response = $this->getJson('/api/rooms');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_show_a_room()
    {
        $room = Room::factory()->create();

        $response = $this->getJson("/api/rooms/{$room->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $room->id]);
    }
}
