<?php

namespace App\View\Components\Runs;

use App\Models\Run;
use App\Models\Vehicle;
use Illuminate\View\Component;

class Day extends Component
{
    public $day;
    public $runs;

    public function __construct($day)
    {
        $this->day = $day;
        $this->runs = Run::with('Vehicle', 'Customer')->whereDate('start_time', '=', $this->day)->orderBy('start_time')->get();

        $this->runs = Vehicle::with('Runs')->whereHas('Runs', function ($q) {
            $q->whereDate('start_time', '=', $this->day);
        })->get();
        // dd($this->runs);
    }



    public function render()
    {
        return view('components.runs.day');
    }
}
