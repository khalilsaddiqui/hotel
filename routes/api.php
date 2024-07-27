<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomFacilityController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('hotels', HotelController::class);
    Route::get('hotels/{hotelId}/rooms', [RoomController::class, 'index']);
    Route::get('hotels/{hotelId}/rooms/{roomId}', [RoomController::class, 'show']);
    Route::post('hotels/{hotelId}/rooms', [RoomController::class, 'store']);
    Route::put('hotels/{hotelId}/rooms/{roomId}', [RoomController::class, 'update']);
    Route::delete('hotels/{hotelId}/rooms/{roomId}', [RoomController::class, 'destroy']);

    Route::get('rooms/{roomId}/facilities', [RoomFacilityController::class, 'index']);
    Route::get('rooms/{roomId}/facilities/{facilityId}', [RoomFacilityController::class, 'show']);
    Route::post('rooms/{roomId}/facilities', [RoomFacilityController::class, 'store']);
    Route::put('rooms/{roomId}/facilities/{facilityId}', [RoomFacilityController::class, 'update']);
    Route::delete('rooms/{roomId}/facilities/{facilityId}', [RoomFacilityController::class, 'destroy']);
});
