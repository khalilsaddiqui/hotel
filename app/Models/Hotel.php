<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name', 'country_code', 'city', 'price_per_night'];

    // Define the relationship with Room model
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
