<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Run;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RunsTable extends Component
{
    public $myRuns, $runToDelete;
    public array $runsToDelete = [];
    public string $mode = 'current';

    protected $listeners = ['addToDeleteRunArr'];


    public function addToDeleteRunArr($id)
    {
        if (!in_array($id, $this->runsToDelete)) {
            $this->runsToDelete[] = $id;
        } else {
            $this->runsToDelete = array_diff($this->runsToDelete, array($id));
        }
    }

    public function deleteSelected()
    {
        if (count($this->runsToDelete) != 0) {
            foreach ($this->runsToDelete as $delete) {
                Run::where('id', $delete)->forceDelete();
            }
            create_banner('Selected runs has been deleted', 'danger');
            $this->redirect(route("runs"));
        }
    }

    public function deleteOldRuns()
    {
        Run::with('Customer')->
        whereDate('start_time', '<', date("Y-m-d"))->
        where('user_id', \Auth::id())->
        orderBy('start_time')->
        delete();
        create_banner('Old runs ended up in the bin', 'danger');
        $this->redirect(route("runs"));
    }

    public function deleteAllInTheBin()
    {
        Run::with('Customer')->
        onlyTrashed()->
        where('user_id', \Auth::id())->forceDelete();
    }


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
