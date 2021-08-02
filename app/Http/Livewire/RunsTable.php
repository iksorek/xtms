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


        if ($this->mode == 'deleted') {
            return Run::with('Customer')->
            onlyTrashed()->
            where('user_id', \Auth::id())->
            orderBy('start_time')->
            get();
        } else {
            !$this->mode || $this->mode == 'current' ? $operator = ">=" : $operator = '<';
            $this->mode == 'old' ? $operator = '<' : '';
            return Run::with('Customer')->
            whereDate('start_time', $operator, date("Y-m-d"))->
            where('user_id', \Auth::id())->
            orderBy('start_time')->
            get();
        }
    }


    public function render()
    {
        $this->myRuns = $this->getMyRuns();
        return view('livewire.runs-table');
    }
}
