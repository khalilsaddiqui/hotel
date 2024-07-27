<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'facility']; // Ensure you have a room_id attribute

    // Define the inverse relationship with Room model
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
