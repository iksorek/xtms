<?php

namespace App\View\Components\Runs;

use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\View\Component;
use Auth;
use phpDocumentor\Reflection\Types\Boolean;

class Day extends Component
{
    public $day, $vehicles, $runsWithoutVehicle;
    public ?string $schedulerErr = null;

    public function __construct($day)
    {
        $this->day = $day;


        $this->vehicles = Vehicle::with(['Runs' => function ($q) use ($day) {
            $q->whereDate('start_time', '=', $day)->orderBy('start_time');
        }])->
        whereHas('Runs', function ($q) use ($day) {
            $q->whereDate('start_time', '=', $day);
        })->
        where('user_id', '=', Auth::id())->get();


        foreach ($this->vehicles as $vehicle) {
            foreach ($vehicle->Runs as $run) {
                if (isset($last_back) && $run->start_time < $last_back) {
                    $this->schedulerErr = 'Runs are overlapping';
                } else
                    $last_back = $run->back_est;
            }
            //todo To be improved, no errors on long runs



        }


        $this->runsWithoutVehicle = Run::with(['Customer', "Vehicle"])
            ->whereDate('start_time', '=', $this->day)
            ->where('user_id', '=', Auth::id())
            ->where(function ($q) {
                return $q->whereNull('customer_id')
                    ->orWhereNull('vehicle_id');
            })
            ->get();

    }


    public
    function render()
    {
        return view('components.runs.day');
    }
}
