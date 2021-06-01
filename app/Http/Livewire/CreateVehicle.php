<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreateVehicle extends Component
{
    public $reg, $make, $model, $mot, $insurance, $tax, $mileage, $service;
    protected $rulesNewVehicle = [
        'reg'=>'required|unique:App\Models\Vehicle,reg',
        'make'=>'required|min:3',
        'model'=>'required',
        'mileage'=>'required|numeric',
        'service'=>'numeric',
        'mot'=>'date',
        'insurance'=>'date',
        'tax'=>'date'
    ];


    public function resetForm()
    {
        return $this->redirect(route('addVehicle'));
    }

    public function checkReg()
    {

            $this->validate(
                [
                    'reg'=>'required|min:3|unique:App\Models\Vehicle,reg',
                ]
            );
            $response = Http::withHeaders([
                'x-api-key' => env('DVLA_API_KEY'),
                'Content-Type' => 'application/json'
            ])->acceptJson()->post(env("DVLA_API_URL"), [
                "registrationNumber" => $this->reg
            ]);
//            dd($response->json());
            $this->make = $response->json('make');
            $this->mot = $response->json('motExpiryDate');
            $this->tax = $response->json('taxDueDate');


    }


    public function storeNewVehicle()
    {
        $this->validate($this->rulesNewVehicle);
        $newVehicle = new Vehicle();
        $newVehicle->user_id = \Auth::id();
        $newVehicle->reg = $this->reg;
        $newVehicle->make = $this->make;
        $newVehicle->model = $this->model;
        $newVehicle->mileage = $this->mileage;
        $newVehicle->service = $this->service;
        $newVehicle->insurance = $this->insurance;
        $newVehicle->mot = $this->mot;
        $newVehicle->tax = $this->tax;
        $newVehicle->save();
        request()->session()->flash('flash.banner', 'New vehicle saved');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect(route('vehicles'));


    }


    public
    function render()
    {
        return view('livewire.create-vehicle');
    }
}
