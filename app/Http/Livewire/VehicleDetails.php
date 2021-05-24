<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleDetails extends Component
{
    public $vehicle;
    public $newmot;
    public $newInsurance;
    public $newService;
    public $mileage;
    protected $listeners = [
        'confirmed',
        'cancelled',
    ];

    protected $rulesMot = [
        'newmot' => 'required|date',
    ];
    protected $rulesInsurance = [
        'newInsurance' => 'required|date',
    ];
    protected $rulesService = [
        'newService' => "required|integer",
    ];

    public function mount()
    {
        $this->newmot = $this->vehicle->mot;
        $this->newInsurance = $this->vehicle->insurance;
        $this->newService = $this->vehicle->service;
        $this->mileage = $this->vehicle->mileage;
    }

    public function saveNewInsuranceDate()
    {
        $this->validate($this->rulesInsurance);
        $this->vehicle->insurance = $this->newInsurance;
        $this->vehicle->save();
    }

    public function saveNewService()
    {
        $this->validate($this->rulesService);
        $this->vehicle->service = $this->newService;
        $this->vehicle->save();
    }

    public function saveNewMotDate()
    {
        $this->validate($this->rulesMot);
        $this->vehicle->mot = $this->newmot;
        $this->vehicle->save();
        //todo SET ALERTS

    }


    public function render()
    {

        return view('livewire.vehicle-details');
    }
}
