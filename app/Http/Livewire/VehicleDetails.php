<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Gate;

class VehicleDetails extends Component
{
    public $vehicle, $mot, $tax, $insurance, $service, $mileage, $reg, $make, $model, $confirmingVehicleDeletion, $service_interval;


    protected $rulesMot = [
        'newmot' => 'required|date',
    ];
    protected $rulesInsurance = [
        'newInsurance' => 'required|date',
    ];


    public function mount()
    {
        Gate::authorize('own', $this->vehicle);
        $this->mot = $this->vehicle->mot;
        $this->make = $this->vehicle->make;
        $this->model = $this->vehicle->model;
        $this->reg = $this->vehicle->reg;
        $this->tax = $this->vehicle->tax;
        $this->insurance = $this->vehicle->insurance;
        $this->service = $this->vehicle->service;
        $this->mileage = $this->vehicle->mileage;
        $this->service_interval = $this->vehicle->service_interval;
        $this->confirmingVehicleDeletion = false;

    }

    public function addIntervalMilesToService()
    {
        $this->vehicle->service = $this->vehicle->service + $this->vehicle->service_interval;
        $this->vehicle->save();
        $newService = $this->vehicle->service;
        request()->session()->flash('flash.banner', 'Next service at ' . $newService . ' saved.');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect(route('vehicleDetails', $this->vehicle->id));

    }

    public function addMonthsTo($months, $to)
    {
        $effectiveDate = strtotime("+$months months", strtotime($this->vehicle->$to));
        $newDate = date("Y-m-d", $effectiveDate);
        $this->vehicle->$to = $newDate;
        $this->vehicle->save();
        request()->session()->flash('flash.banner', 'Date has benn changed to  ' . $newDate . '.');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect(route('vehicleDetails', $this->vehicle->id));
    }

    public function cancelChanges()
    {
        request()->session()->flash('flash.banner', 'Nothing has been updated');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect(route('myvehicles'));
    }

    public function updateVehicle()
    {
        $this->vehicle->mot = $this->mot;
        $this->vehicle->make = $this->make;
        $this->vehicle->model = $this->model;
        $this->vehicle->tax = $this->tax;
        $this->vehicle->insurance = $this->insurance;
        $this->vehicle->service = $this->service;
        $this->vehicle->mileage = $this->mileage;
        $this->vehicle->service_interval = $this->service_interval;
        $this->vehicle->save();

        create_banner('Changes has been saved');
        return redirect()->to(route('vehicleDetails', $this->vehicle->id));

    }

    public function deleteVehicle()
    {
        $this->vehicle->delete();
        request()->session()->flash('flash.banner', 'Vehicle deleted');
        request()->session()->flash('flash.bannerStyle', 'danger');
        return redirect()->to(route('myvehicles'));


    }

    public function render()
    {

        return view('livewire.vehicle-details');
    }
}
