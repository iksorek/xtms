<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
{
    use HandlesAuthorization;


    public function show(User $user, Vehicle $vehicle)
    {
        return $user->id === $vehicle->user_id || auth()->user()->hasRole('admin');
    }
}
