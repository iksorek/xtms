<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Run;
use App\Models\User;
use Livewire\Component;

class RunsTable extends Component
{
    public $myRuns, $runToDelete;


    protected $listeners = ['deleteModal', 'hideDeleteModal'];

    public function deleteModal($run)
    {
        $this->runToDelete = Run::with('Customer')->findOrFail($run);
    }

    public function deleteRun(Run $run)
    {
        $run->delete();
        create_banner('Run deleted', 'danger');
        $this->runToDelete = false;
        $this->redirect(route('runs'));
    }


    public function cancelDelete()
    {
        $this->runToDelete = false;
    }

    public function getMyRuns($mode = 'new')
    {
        return Run::with('Customer')->
        whereDate('start_time', ">=", date("Y-m-d"))->
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
