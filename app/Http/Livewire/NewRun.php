<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewRun extends Component
{

    public $newrun, $cost, $customer, $vehicle, $date, $startTime, $finishEst, $additional_info;
    public $vehicles, $customers, $addNewCustomerForm;
    protected $listeners = ['assignCustomer'];


    public function assignCustomer($id)
    {

        $this->customer = $id;
    }

    public function mount()
    {
        $this->cost = $this->newrun['costApr'];
        $this->vehicles = Vehicle::where('user_id', Auth::id())->get();
        $this->customers = Customer::where('user_id', Auth::id())->orderBy('name')->get();
        $this->date = date("Y-m-d", strtotime('tomorrow'));
        $this->startTime = "10:00";
        $this->addNewCustomerForm = false;
    }

    protected $rules = [
        'cost' => 'required|numeric|min:1',
        'date' => 'required|after_or_equal:NOW',


    ];

    public function saveNewRun()
    {
        $run = new Run();
        $run->user_id = Auth::id();
        $run->vehicle_id = $this->vehicle;
        $run->postcode_from = $this->newrun['postcodesStart'];
        $run->postcode_to = $this->newrun['postcodesFinish'];

        $run->long_from = $this->newrun['long_from'];
        $run->lat_from = $this->newrun['lat_from'];
        $run->long_to = $this->newrun['long_to'];
        $run->lat_to = $this->newrun['lat_to'];


        $run->distance = $this->newrun['distance'];
        $run->customer_id = $this->customer;
        $run->price = $this->cost;
        $run->start_time = "$this->date $this->startTime";
        $run->finish_est = date("Y-m-d H:i:s", strtotime($run->start_time) + ($this->newrun['time'] * 60));
        $run->back_est = date("Y-m-d H:i:s", strtotime($run->start_time) + ($this->newrun['time'] * 60 * 2) + 3600);
        $run->additional_info = $this->additional_info;
        $this->validate();
        $run->save();
        create_banner('New run has been saved!');
        $this->redirectRoute('runs');
    }

    public function render()
    {


        return view('livewire.new-run');
    }
}
