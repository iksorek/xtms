<?php

namespace App\Http\Livewire;

use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewRun extends Component
{

    public $newrun, $cost, $vehicle, $date, $startTime, $finishEst, $info;
    public $vehicles;

    public function mount()
    {
        $this->cost = $this->newrun['costApr'];
        $this->vehicles = Vehicle::where('user_id', Auth::id())->get();
    }

    public function saveNewRun()
    {
        $run = new Run();
        $run->user_id = Auth::id();
        $run->vehicle_id = $this->vehicle;
        $run->postcode_from = $this->newrun['postcodesStart'];
        $run->postcode_to = $this->newrun['postcodesFinish'];
        $run->distance = $this->newrun['distance'];
        $run->start_time = "$this->date $this->startTime";
        $run->save();
        $this->redirectRoute('runs');
    }

    public function render()
    {


        return view('livewire.new-run');
    }
}
