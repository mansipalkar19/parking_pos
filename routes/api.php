<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\VendorController;
use App\Models\Vehicle;

Route::post('/create-operators', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/listRoles', [MasterController::class, 'listRoles']);
Route::get('/roles/datatable', [MasterController::class, 'listRoles']);

Route::get('/listPlacess', [MasterController::class, 'listPlacess']);
Route::get('/places/datatable', [MasterController::class, 'listPlacess']);

Route::get('/listVehicletypes', [MasterController::class, 'listVehicletypes']);
Route::get('/listVehicletypes/datatable', [MasterController::class, 'listVehicletypes']);

Route::middleware(['apiauth'])->group(function () {
    // Roles
    Route::post('/addRoles', [MasterController::class, 'addRoles']);
    Route::post('/updateRoles/{id}', [MasterController::class, 'updateRoles']);
    Route::post('/roles/{id}/delete', [MasterController::class, 'destroyRoles']);

    //Vehicles
    Route::post('/addVehicleTypes', [MasterController::class, 'addVehicleTypes']);
    Route::post('/updateVehicleTypes/{id}', [MasterController::class, 'updateVehicleTypes']);
    Route::post('/destroyVehicleTypes/{id}/destroyVehicleTypes', [MasterController::class, 'destroyVehicleTypes']);

    //Parking Rates
    Route::get('/listParkingRates', [MasterController::class, 'listParkingRates']);
    Route::get('/listParkingRates/datatable', [MasterController::class, 'listParkingRates']);
    Route::post('/addParkingRates', [MasterController::class, 'addParkingRates']);
    Route::post('/updateParkingRates/{id}', [MasterController::class, 'updateParkingRates']);
    Route::post('/destroyParkingRates/{id}/destroyParkingRates', [MasterController::class, 'destroyParkingRates']);


    // Places
    Route::get('/places', [PlaceController::class, 'index']);
    Route::post('/places', [PlaceController::class, 'store']);
    Route::get('/places/{id}', [PlaceController::class, 'show']);
    Route::put('/places/{id}', [PlaceController::class, 'update']);
    Route::delete('/places/{id}', [PlaceController::class, 'destroy']);
});

Route::get('/places-list/{id}', [PlaceController::class, 'show']);


Route::prefix('vendor')->group(function () {
    Route::get('/pending', [VendorController::class, 'pending']);
    Route::get('/approved', [VendorController::class, 'approved']);
    Route::get('/rejected', [VendorController::class, 'rejected']);

    Route::post('/{id}/approve', [VendorController::class, 'approve']);
    Route::post('/{id}/reject', [VendorController::class, 'reject']);
});
