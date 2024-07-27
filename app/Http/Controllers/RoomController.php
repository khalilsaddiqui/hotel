<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // List all rooms for a specific hotel
    public function index($hotelId)
    {
        $hotel = Hotel::find($hotelId);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found.'], 404);
        }
        $rooms = $hotel->rooms;
        return response()->json($rooms);
    }

    // Show a specific room
    public function show($hotelId, $roomId)
    {
        $room = Room::where('hotel_id', $hotelId)->find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found.'], 404);
        }
        return response()->json($room);
    }

    // Create a new room for a specific hotel
    public function store(Request $request, $hotelId)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $hotel = Hotel::find($hotelId);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found.'], 404);
        }

        $room = new Room();
        $room->hotel_id = $hotel->id;
        $room->room_type = $request->room_type;
        $room->price = $request->price;
        $room->save();

        return response()->json($room, 201);
    }

    // Update a specific room
    public function update(Request $request, $hotelId, $roomId)
    {
        $request->validate([
            'room_type' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $room = Room::where('hotel_id', $hotelId)->find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found.'], 404);
        }

        if ($request->has('room_type')) {
            $room->room_type = $request->room_type;
        }
        if ($request->has('price')) {
            $room->price = $request->price;
        }
        $room->save();

        return response()->json($room);
    }

    // Delete a specific room
    public function destroy($hotelId, $roomId)
    {
        $room = Room::where('hotel_id', $hotelId)->find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found.'], 404);
        }

        $room->delete();
        return response()->json(['message' => 'Room deleted successfully.']);
    }
}
