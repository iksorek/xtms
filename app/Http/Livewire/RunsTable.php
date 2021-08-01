<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Run;
use App\Models\User;
use Livewire\Component;

class RunsTable extends Component
{
    public $myRuns, $runToDelete, $mode;



    public function getMyRuns()
    {
        !$this->mode || $this->mode == 'active' ? $operator = ">=" : $operator = '<';

        return Run::with('Customer')->
        whereDate('start_time', $operator, date("Y-m-d"))->
        where('user_id', \Auth::id())->
        orderBy('start_time')->
        get();
    }


    public function mount()
    {
        $this->myRuns = $this->getMyRuns();

    }

    public function render()
    {


        return view('livewire.runs-table');
    }
}
