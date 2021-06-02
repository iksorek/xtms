<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VehicleList extends Component
{
    public $vehs = null;
    public $mileage;
    public $showModal = false;

    public function toggleModal($vehicle)
    {
        return $this->showModal = $vehicle;

    }


    public function updateMileAge($newMileage)
    {
        $van = Vehicle::findOrFail($this->showModal);
        $van->mileage = $newMileage;
        $van->save();
    }

    public function render()
    {

        $this->vehs = Vehicle::withCount('Runs')->where('user_id', Auth::id())->get();

        return view('livewire.vehicle-list');
    }
}
