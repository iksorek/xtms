<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/myCustomers', [CustomerController::class, 'index'])->name('myCustomers');
    Route::get('/vehicledetails/{vehicleID}', [VehicleController::class, 'show'])->name('vehicleDetails');
    Route::get('/myvehicles', function () {
        return view('myvehicles');
    })->name('vehicles');

});


