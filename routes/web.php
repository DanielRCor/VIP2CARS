<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - VIP2CARS
|--------------------------------------------------------------------------
*/

// Redirige la raíz al listado de vehículos
Route::get('/', fn () => redirect()->route('vehicles.index'));

// CRUD de vehículos (incluye: index, create, store, show, edit, update, destroy)
Route::resource('vehicles', VehicleController::class);
