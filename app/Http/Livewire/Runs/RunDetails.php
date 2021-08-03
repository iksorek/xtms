<?php

namespace App\Http\Livewire\Runs;

use App\Models\Run;
use Livewire\Component;

class RunDetails extends Component
{
    public $run;
    public $delete = false;


    public function deleteRun(Run $run)
    {
        $run->delete();
        create_banner('Run moved to trash', 'danger');

        $this->redirect(route('runs'));
    }

    public function toggleDelete()
    {
        $this->delete = !$this->delete;
    }

    public function setAsFinished(){
        $this->run->finished = now();
        $this->run->save();
    }

    public function togglePaid()
    {
        $this->run->paid = !$this->run->paid;
        $this->run->save();
    }


    public
    function render()
    {


        return view('livewire.runs.run-details');
    }
}
