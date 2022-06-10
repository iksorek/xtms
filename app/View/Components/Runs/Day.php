<?php

namespace App\View\Components\Runs;

use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\View\Component;
use Auth;
use phpDocumentor\Reflection\Types\Boolean;

class Day extends Component
{
    public string $day;
    public $mode = null;
    public $vehicles, $runsWithoutVehicle;
    public ?object $schedulerErr = null;


    public function __construct($day, $mode = null)
    {
        $this->schedulerErr = new \stdClass();
        $this->day = $day;
        $this->mode = $mode;

        if (!$mode) {
            $this->vehicles = Vehicle::with(['Runs' => function ($q) use ($day) {
                $q->whereDate('start_time', '=', $day)->orderBy('start_time');
            }])->
            whereHas('Runs', function ($q) use ($day) {
                $q->whereDate('start_time', '=', $day);
            })->
            where('user_id', '=', Auth::id())->get();
        } else {
            $this->vehicles = Auth::user()->Vehicles()->with(['Runs' => function ($q) use ($day) {
                $q->where('status', 'requested')->whereDate('start_time', '=', $day)->orderBy('start_time');

            }]);

        }

        foreach ($this->vehicles as $vehicle) {
            $last_back = null;
            foreach ($vehicle->Runs as $run) {
                if (isset($last_back) && $run->start_time < $last_back) {
                    $this->schedulerErr->desc = 'Runs are overlapping';
                    $this->schedulerErr->veh = $vehicle->id;

                } else
                    $last_back = $run->back_est;
            }
            //todo To be improved, no errors on long runs


        }

        if (!$mode) {
            $this->runsWithoutVehicle = Run::with(['Customer', "Vehicle"])
                ->whereDate('start_time', '=', $this->day)
                ->where('user_id', '=', Auth::id())
                ->where(function ($q) {
                    return $q->whereNull('customer_id')
                        ->orWhereNull('vehicle_id');
                })
                ->get();
        } else {
            $this->runsWithoutVehicle = Auth::user()->Runs()
                ->whereDate('start_time', '=', $this->day)
                ->where('status', 'requested')

                ->get();
        }
    }


    public function render()
    {
        return view('components.runs.day');
    }
}
