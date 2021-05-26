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
        request()->session()->flash('flash.banner', 'Insurance renewal date saved');
        request()->session()->flash('flash.bannerStyle', 'success');
    }

    public function saveNewService()
    {
        $this->validate([
            'newService' => "required|numeric|min:" . $this->mileage,

        ]);
        $this->vehicle->service = $this->newService;
        $this->vehicle->save();
        request()->session()->flash('flash.banner', 'Next service mileage saved');
        request()->session()->flash('flash.bannerStyle', 'success');
    }

    public function addIntervalMilesToService()
    {
        $this->vehicle->service = $this->vehicle->service + 6000;
        $this->vehicle->save();
        $this->newService = $this->vehicle->service;
        request()->session()->flash('flash.banner', 'Next service at ' . $this->newService . ' saved.');
        request()->session()->flash('flash.bannerStyle', 'success');

    }

    public function saveNewMotDate()
    {
        $this->validate($this->rulesMot);
        $this->vehicle->mot = $this->newmot;
        $this->vehicle->save();
        request()->session()->flash('flash.banner', 'Next MOT date saved');
        request()->session()->flash('flash.bannerStyle', 'success');

    }


    public function render()
    {

        return view('livewire.vehicle-details');
    }
}
