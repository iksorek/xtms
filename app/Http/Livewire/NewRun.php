<?php

namespace App\Http\Livewire;

use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewRun extends Component
{

    public $newrun, $cost, $vehicle, $date, $startTime, $finishEst, $info, $additional_info;
    public $vehicles;

    public function mount()
    {
        $this->cost = $this->newrun['costApr'];
        $this->vehicles = Vehicle::where('user_id', Auth::id())->get();
        $this->date = date("Y-m-d", strtotime('tomorrow'));
        $this->startTime = "10:00";
    }

    public function saveNewRun()
    {
        $run = new Run();
        $run->user_id = Auth::id();
        $run->vehicle_id = $this->vehicle;
        $run->postcode_from = $this->newrun['postcodesStart'];
        $run->postcode_to = $this->newrun['postcodesFinish'];
        $run->distance = $this->newrun['distance'];
        $run->price = $this->cost;
        $run->start_time = "$this->date $this->startTime";
        $run->finish_est = date("Y-m-d H:i:s", strtotime($run->start_time) + ($this->newrun['time'] * 60));
        $run->back_est = date("Y-m-d H:i:s", strtotime($run->start_time) + ($this->newrun['time'] * 60 * 2) + 3600);
        $run->additional_info = $this->additional_info;

        $run->save();
        $this->redirectRoute('runs');
    }

    public function render()
    {


        return view('livewire.new-run');
    }
}
