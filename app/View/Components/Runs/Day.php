<?php

namespace App\View\Components\Runs;

use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\View\Component;
use Auth;

class Day extends Component
{
    public $day, $vehicles, $runsWithoutVehicle;

    public function __construct($day)
    {
        $this->day = $day;
//        $this->runs = Run::with('Vehicle', 'Customer')->whereDate('start_time', '=', $this->day)->orderBy('start_time')->get();

        $this->vehicles = Vehicle::with('Runs')->where('user_id', '=', Auth::id())->whereHas('Runs', function ($q) {
            $q->whereDate('start_time', '=', $this->day);
        })->get();
        $this->runsWithoutVehicle = Run::with('Customer')
            ->where('user_id', '=', Auth::id())
            ->where('customer_id', '=', null)
            ->orWhere('vehicle_id', '=', null)
            ->whereDate('start_time', '=', $this->day)->get();


        // dd($this->runs);
    }


    public function render()
    {
        return view('components.runs.day');
    }
}
