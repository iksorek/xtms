<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class EditRun extends Component
{
    public $run;
    public $cost, $customer, $vehicle, $date, $startTime, $finishEst, $additional_info, $postcode_from, $postcode_to, $distance;
    public $vehicles, $customers, $newVehicle, $newCustomer, $back_est, $finish_est, $status;


    protected $rules = [

        'postcode_from' => 'required|min:5',
        'postcode_to' => 'required|min:5|different:postcode_from',
        'cost' => 'numeric',
        'date' => 'required|date|after_or_equal:yesterday',
        'newCustomer' => 'required|exists:customers,id',
        'newVehicle' => 'required|exists:vehicles,id'
    ];
    protected $recalculationRules = [
        'postcode_from' => 'required|min:5',
        'postcode_to' => 'required|min:5|different:postcode_from',

    ];


    public function mount()
    {
        $this->postcode_from = $this->run->postcode_from;
        $this->postcode_to = $this->run->postcode_to;
        $this->cost = $this->run->price;
        $this->customer = $this->run->Customer;
        $this->distance = $this->run->distance;
        $this->vehicle = $this->run->Vehicle;
        $this->back_est = $this->run->back_est;
        $this->finish_est = $this->run->finish_est;
        $this->date = date("Y-m-d", strtotime($this->run->start_time));
        $this->startTime = date("H:i", strtotime($this->run->start_time));
        $this->additional_info = $this->run->additional_info;
        $this->status = $this->run->status;
        $this->run->Customer ? $this->newCustomer = $this->run->Customer->id : $this->newCustomer = 0;
        !$this->run->Vehicle ?: $this->newVehicle = $this->run->Vehicle->id;
//        $this->newVehicle = $this->run->Vehicle->id;


        $this->vehicles = Auth::user()->Vehicles;
        $this->customers = Auth::user()->Customers;
    }


    public function updateRun()
    {
        $this->validate($this->rules);
        $this->run->postcode_from = $this->postcode_from;
        $this->run->postcode_to = $this->postcode_to;
        $this->run->price = $this->cost;
        $this->run->back_est = $this->back_est;
        $this->run->finish_est = $this->finish_est;

        $this->run->distance = $this->distance;
        $this->run->customer_id = $this->customer;
        $this->run->vehicle_id = $this->newVehicle;
        $this->run->customer_id = $this->newCustomer;
        $this->run->start_time = "$this->date $this->startTime";
        $this->run->additional_info = $this->additional_info;
        create_banner('Changes has been saved');
        $this->run->save();
        $this->redirectRoute('editRun', $this->run->id);

    }

    public function recalculateRun()
    {
        $this->validate($this->recalculationRules);
        $response = getQuote($this->postcode_from, $this->postcode_to);
        $this->cost = $response['costApr'];
        $this->distance = $response['distance'];
        $start_time = "$this->date $this->startTime";
        $this->finish_est = date("Y-m-d H:i:s", strtotime($start_time) + ($response['time'] * 60));
        $this->back_est = date("Y-m-d H:i:s", strtotime($start_time) + ($response['time'] * 60 * 2) + 3600);

    }

    public function setNewStatus($status)
    {
        $this->run->status = $status;
        $this->status = $status;
        $this->run->save();
    }

    public function render()
    {
        return view('livewire.edit-run');
    }
}
