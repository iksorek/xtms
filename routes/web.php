<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RunController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    if (Auth::check()) {

        if (Auth::user()->hasRole('admin')) {
            return redirect(route('admin'));
        } else {
            return redirect(route('dashboard'));
        }
    } else {
        return view('welcome');
    }
});
Route::get('authLogout', [AuthenticatedSessionController::class, 'destroy'])->name('authLogout');
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard/{mode?}', function ($mode = null) {
        if ($mode == 'requested') {
            return view('dashboard', ['mode' => 'requested']);
        } else {
            return view('dashboard');
        }
    })->name('dashboard')->middleware('role:user|admin');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/myCustomers', [CustomerController::class, 'index'])->name('myCustomers');
    Route::get('/vehicledetails/{vehicleID}', [VehicleController::class, 'show'])->name('vehicleDetails');
    Route::get('/myvehicles', [VehicleController::class, 'index'])->name('myvehicles');
    Route::get('/myvehicles/add', [VehicleController::class, 'create'])->name('addVehicle');
    Route::put('/myvehicles/store', [VehicleController::class, 'store'])->name('storeVehicle');
    Route::get('/runs/', [RunController::class, 'index'])->name('runs');
    Route::get('/run/{runId}', [RunController::class, 'show'])->name('showRun');
    Route::get('/editrun/{runId}', [RunController::class, 'edit'])->name('editRun');
    Route::get('/mysettings', [Controller::class, 'mysettings'])->name('mysettings');
    Route::get('/admin', [AdminController::class, 'AdminDashboard'])->middleware(['role:admin'])->name('admin');


});


