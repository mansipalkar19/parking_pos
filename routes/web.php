<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ParkingRatesWebController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlaceWebController;
use App\Http\Controllers\RoleWebController;
use App\Http\Controllers\VehicleWebController;
use App\Http\Controllers\VendorListWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::post('/userroles/store', [RoleWebController::class, 'store'])->name('userroles.store');
    Route::post('/userroles/{id}', [RoleWebController::class, 'update']);
    Route::post('/userroles/{id}/delete', [RoleWebController::class, 'destroy']);

    //places
    Route::post('/placename/store', [PlaceWebController::class, 'store'])->name('placename.store');
    Route::post('/placename/{id}', [PlaceWebController::class, 'update'])
        ->name('placename.update');

    Route::post('/placename/{id}/delete', [PlaceWebController::class, 'destroy'])
        ->name('placename.delete');

    //Vehicletype
    Route::post('/vehicletype/add', [VehicleWebController::class, 'add'])
        ->name('vehicletype.add');
    Route::post('/vehicletype/{id}', [VehicleWebController::class, 'update'])
        ->name('vehicletype.update');
    Route::post('/vehicletype/{id}/delete', [VehicleWebController::class, 'destroy'])->name('vehicletype.delete');

    //vendor access accept or reject
    // Route::post('/vehicletype/add', [VehicleWebController::class, 'add'])
    //     ->name('vehicletype.add');
    Route::post('/vendorlist/{id}', [VendorListWebController::class, 'approve'])
        ->name('vendorlist.approve');
    Route::post('/vendorlist/{id}/reject', [VendorListWebController::class, 'reject'])->name('vendorlist.reject');;


    //Parkingrates
    Route::post('/parkingrates/{id}', [ParkingRatesWebController::class, 'updateparkingrates']);
    Route::post('/parkingrates/{id}/delete', [ParkingRatesWebController::class, 'destroyparkingrates']);
    Route::post('/parkingrates/store', [ParkingRatesWebController::class, 'store'])->name('parkingrates.store');
});

// Route::get('/userroles', function () {
//     return view('admin.userroles');
// })->name('userroles');

Route::get('/userroles', [RoleWebController::class, 'index'])->name('userroles');
Route::get('/placenames', [PlaceWebController::class, 'index'])->name('placenames');
Route::get('/vehicletype', [VehicleWebController::class, 'index'])->name('vehicletype');
Route::get('/vendorlist', [VendorListWebController::class, 'index'])
    ->name('vendorlist');
Route::get('/parkingrates', [VehicleWebController::class, 'index'])->name('parkingrates');
