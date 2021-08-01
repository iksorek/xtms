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
        create_banner('Run deleted', 'danger');

        $this->redirect(route('runs'));
    }

    public function toggleDelete()
    {
        $this->delete = !$this->delete;
    }

    public function updateColumn($col)
    {
        if ($col == 'finished') {
            $this->run->finished ? $this->run->finished = null : $this->run->finished = now();

        } else {

            $this->run->$col = !$this->run->$col;

        }
        $this->run->save();
    }


    public function render()
    {


        return view('livewire.runs.run-details');
    }
}
