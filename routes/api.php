<?php

use App\Http\Controllers\AccommodationAllocationController;
use App\Http\Controllers\accommodationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TravelAgentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('travel-agents/search', [TravelAgentController::class, 'search']);
    Route::resource('travel-agents', TravelAgentController::class);

    Route::get('accommodations/search', [AccommodationController::class, 'search']);
    Route::resource('accommodations', AccommodationController::class);

    Route::get('contracts/search', [ContractController::class, 'search']);
    Route::resource('contracts', ContractController::class);

    Route::get('accommodation-allocations/search', [AccommodationAllocationController::class, 'search']);
    Route::resource('accommodation-allocations', AccommodationAllocationController::class);
});
