<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RunController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/myCustomers', [CustomerController::class, 'index'])->name('myCustomers');
    Route::get('/vehicledetails/{vehicleID}', [VehicleController::class, 'show'])->name('vehicleDetails');
    Route::get('/myvehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('/myvehicles/add', [VehicleController::class, 'create'])->name('addVehicle');
    Route::put('/myvehicles/store', [VehicleController::class, 'store'])->name('storeVehicle');
    Route::get('/runs', [RunController::class, 'index'])->name('runs');
    Route::get('/run/{runId}', [RunController::class, 'show'])->name('showRun');
    Route::get('/editrun/{runId}', [RunController::class, 'edit'])->name('editRun');
    Route::get('/mysettings', [Controller::class, 'mysettings'])->name('mysettings');


});


