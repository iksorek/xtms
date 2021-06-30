<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class EditRun extends Component
{
    public $run;
    public $cost, $customer, $vehicle, $date, $startTime, $finishEst, $additional_info, $postcode_from, $postcode_to;
    public $vehicles, $customers, $addNewCustomerForm;

    public function mount()
    {
        $this->postcode_from = $this->run->postcode_from;
        $this->postcode_to = $this->run->postcode_to;
        $this->cost = $this->run->price;
        $this->customer = $this->run->Customer;
        $this->vehicle = $this->run->Vehicle;
        $this->date = date("Y-m-d", strtotime($this->run->start_time));
        $this->startTime = date("H:i", strtotime($this->run->start_time));
        $this->additional_info = $this->run->additional_info;

        $this->vehicles = Auth::user()->Vehicles;
        $this->customers = Auth::user()->Customers;
    }

    public function render()
    {
        return view('livewire.edit-run');
    }
}
