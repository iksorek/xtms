<?php

namespace App\Http\Livewire;

use App\Models\Run;
use Livewire\Component;

class Runs extends Component
{

    public $myRuns;
    public $addRun = false;


    public function getMyRuns()
    {
        return Run::where('user_id', \Auth::id())->get();
    }

    public function mount()
    {
        $this->myRuns = $this->getMyRuns();
    }

    public function render()
    {
        return view('livewire.runs');
    }
}
