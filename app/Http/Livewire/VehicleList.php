<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VehicleList extends Component
{
    public $vehs = null;
    public $showModal = false;

    public function toggleModal($vehicle){
       return $this->showModal = $vehicle;

    }

    public function render()
    {
        $this->vehs = Vehicle::where('user_id', Auth::id())->get();
        return view('livewire.vehicle-list');
    }
}
