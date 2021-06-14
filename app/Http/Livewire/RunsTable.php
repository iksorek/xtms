<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Run;
use App\Models\User;
use Livewire\Component;

class RunsTable extends Component
{
    public $myRuns;
    public $confirmingRunDeletion = false;
    protected $listeners = ['deleteModal', 'hideDeleteModal'];

    public function deleteModal(Run $run)
    {
        $this->confirmingRunDeletion = $run;

    }

    public function hideDeleteModal()
    {
        $this->confirmingRunDeletion = false;
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
