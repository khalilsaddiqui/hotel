<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        {
            $query = Hotel::query();
    
            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
    
            if ($request->has('country_code')) {
                $query->where('country_code', $request->country_code);
            }
    
            if ($request->has('city')) {
                $query->where('city', 'like', '%' . $request->city . '%');
            }
    
            if ($request->has('min_price') || $request->has('max_price')) {
                $query->whereHas('rooms', function ($roomQuery) use ($request) {
                    if ($request->has('min_price')) {
                        $roomQuery->where('price', '>=', $request->min_price);
                    }
                    if ($request->has('max_price')) {
                        $roomQuery->where('price', '<=', $request->max_price);
                    }
                });
            }
    
            // Sorting
            if ($request->has('sort_by') && $request->has('sort_order')) {
                $sortBy = $request->sort_by;
                $sortOrder = $request->sort_order;
    
                if (in_array($sortBy, ['name', 'country_code', 'city']) && in_array($sortOrder, ['asc', 'desc'])) {
                    $query->orderBy($sortBy, $sortOrder);
                } elseif ($sortBy == 'price' && in_array($sortOrder, ['asc', 'desc'])) {
                    $query->join('rooms', 'hotels.id', '=', 'rooms.hotel_id')
                          ->orderBy('rooms.price', $sortOrder)
                          ->select('hotels.*');
                }
            }
    
            $hotels = $query->with(['rooms'])->get();
    
            return response()->json($hotels);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'country_code' => 'required|string|size:2',
            'city' => 'required|string',
            'price_per_night' => 'required|numeric',
        ]);

        $hotel = Hotel::create($request->all());

        return response()->json($hotel, 201);
    }

    public function show($id)
    {
        return Hotel::with('rooms')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'country_code' => 'string|size:2',
            'city' => 'string',
            'price_per_night' => 'numeric',
        ]);

        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());

        return response()->json($hotel);
    }

    public function destroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}