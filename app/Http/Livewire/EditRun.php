<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class EditRun extends Component
{
    public $run;
    public $cost, $customer, $vehicle, $date, $startTime, $finishEst, $additional_info, $postcode_from, $postcode_to, $distance;
    public $vehicles, $customers, $addNewCustomerForm, $newVehicle, $newCustomer;

    protected $rules = [

        'postcode_from' => 'required|min:7',
        'postcode_to' => 'required|min:7|different:postcode_from',
        'cost' => 'required|min:1',
        'distance' => 'required',
        'date' => 'required|after_or_equal:NOW',
        'newCustomer' => 'required|exists:customers,id',
        'newVehicle' => 'required|exists:vehicles,id'
    ];

    public function mount()
    {
        $this->postcode_from = $this->run->postcode_from;
        $this->postcode_to = $this->run->postcode_to;
        $this->cost = $this->run->price;
        $this->customer = $this->run->Customer;
        $this->distance = $this->run->distance;
        $this->vehicle = $this->run->Vehicle;
        $this->date = date("Y-m-d", strtotime($this->run->start_time));
        $this->startTime = date("H:i", strtotime($this->run->start_time));
        $this->additional_info = $this->run->additional_info;

        $this->run->Customer ? $this->newCustomer = $this->run->Customer->id : $this->newCustomer = 0;

        $this->newVehicle = $this->run->Vehicle->id;


        $this->vehicles = Auth::user()->Vehicles;
        $this->customers = Auth::user()->Customers;
    }


    public function updateRun()
    {
        $this->validate($this->rules);
        $this->run->postcode_from = $this->postcode_from;
        $this->run->postcode_to = $this->postcode_to;
        $this->run->price = $this->cost;
        $this->run->distance = $this->distance;
        $this->run->customer_id = $this->customer;
        $this->run->vehicle_id = $this->newVehicle;
        $this->run->customer_id = $this->newCustomer;
        $this->run->start_time = "$this->date $this->startTime";
        $this->run->additional_info = $this->additional_info;


        request()->session()->flash('flash.banner', 'Changes has been saved');
        request()->session()->flash('flash.bannerStyle', 'success');
        $this->run->save();
        $this->redirectRoute('editRun', $this->run->id);


    }

    public function recalculateRun()
    {
        $this->validate();
        $response = getQuote($this->postcode_from, $this->postcode_to);
        $this->cost = $response['costApr'];
        $this->distance = $response['distance'];

    }

    public function render()
    {
        return view('livewire.edit-run');
    }
}
