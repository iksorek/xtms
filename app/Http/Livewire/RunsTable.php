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
        request()->session()->flash('flash.banner', 'Run deleted');
        request()->session()->flash('flash.bannerStyle', 'danger');
        $this->runToDelete = false;
        $this->redirect(route('runs'));
    }

    public function refreshParent()
    {

    }

    public function cancelDelete()
    {
        $this->runToDelete = false;
    }

    public function getMyRuns()
    {
        return Run::with('Customer')->where('user_id', \Auth::id())->get();
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
