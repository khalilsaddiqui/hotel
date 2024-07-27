<?php

namespace Tests\Unit;

use App\Models\RoomFacility;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomFacilityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_room_facility()
    {
        $room = Room::factory()->create();

        $data = [
            'room_id' => $room->id,
            'facility' => 'WiFi',
        ];

        $response = $this->postJson('/api/room-facilities', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('room_facilities', $data);
    }

    /** @test */
    public function it_can_update_a_room_facility()
    {
        $roomFacility = RoomFacility::factory()->create();

        $data = [
            'facility' => 'Updated Facility',
        ];

        $response = $this->putJson("/api/room-facilities/{$roomFacility->id}", $data);
        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('room_facilities', $data);
    }

    /** @test */
    public function it_can_delete_a_room_facility()
    {
        $roomFacility = RoomFacility::factory()->create();

        $response = $this->deleteJson("/api/room-facilities/{$roomFacility->id}");
        $response->assertStatus(204);

        $this->assertDatabaseMissing('room_facilities', ['id' => $roomFacility->id]);
    }

    /** @test */
    public function it_can_list_room_facilities()
    {
        $roomFacilities = RoomFacility::factory()->count(3)->create();

        $response = $this->getJson('/api/room-facilities');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_show_a_room_facility()
    {
        $roomFacility = RoomFacility::factory()->create();

        $response = $this->getJson("/api/room-facilities/{$roomFacility->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $roomFacility->id]);
    }
}
