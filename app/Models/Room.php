<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'room_type', 'price']; // Adjust attributes as needed

    // Define the relationship with Hotel model
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // Define the relationship with RoomFacility model
    public function roomFacilities()
    {
        return $this->hasMany(RoomFacility::class);
    }
}
