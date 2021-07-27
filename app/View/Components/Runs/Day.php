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


        $this->vehicles = Vehicle::with(['Runs' => function ($q) use ($day) {
            $q->whereDate('start_time', '=', $day);
        }])->
        whereHas('Runs', function ($q) use ($day) {
            $q->whereDate('start_time', '=', $day);
        })->
        where('user_id', '=', Auth::id())->get();


        $this->runsWithoutVehicle = Run::with(['Customer', "Vehicle"])
            ->whereDate('start_time', '=', $this->day)
            ->where('user_id', '=', Auth::id())
            ->where(function ($q) {
                return $q->whereNull('customer_id')
                    ->orWhereNull('vehicle_id');
            })
            ->get();

    }


    public function render()
    {
        return view('components.runs.day');
    }
}
