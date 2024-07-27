<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomFacility;
use Illuminate\Http\Request;

class RoomFacilityController extends Controller
{
    // List all facilities for a specific room
    public function index($roomId)
    {
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found.'], 404);
        }
        $facilities = $room->roomFacilities;
        return response()->json($facilities);
    }

    // Show a specific facility
    public function show($roomId, $facilityId)
    {
        $facility = RoomFacility::where('room_id', $roomId)->find($facilityId);
        if (!$facility) {
            return response()->json(['message' => 'Facility not found.'], 404);
        }
        return response()->json($facility);
    }

    // Create a new facility for a specific room
    public function store(Request $request, $roomId)
    {
        $request->validate([
            'facility' => 'required|string|max:255',
        ]);

        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found.'], 404);
        }

        $facility = new RoomFacility();
        $facility->room_id = $room->id;
        $facility->facility = $request->facility;
        $facility->save();

        return response()->json($facility, 201);
    }

    // Update a specific facility
    public function update(Request $request, $roomId, $facilityId)
    {
        $request->validate([
            'facility' => 'sometimes|required|string|max:255',
        ]);

        $facility = RoomFacility::where('room_id', $roomId)->find($facilityId);
        if (!$facility) {
            return response()->json(['message' => 'Facility not found.'], 404);
        }

        if ($request->has('facility')) {
            $facility->facility = $request->facility;
        }
        $facility->save();

        return response()->json($facility);
    }

    // Delete a specific facility
    public function destroy($roomId, $facilityId)
    {
        $facility = RoomFacility::where('room_id', $roomId)->find($facilityId);
        if (!$facility) {
            return response()->json(['message' => 'Facility not found.'], 404);
        }

        $facility->delete();
        return response()->json(['message' => 'Facility deleted successfully.']);
    }
}
