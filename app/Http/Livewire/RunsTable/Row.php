<?php

namespace App\Http\Livewire\RunsTable;

use Livewire\Component;
use phpDocumentor\Reflection\Element;

class Row extends Component
{

    public $oneRun;

    public function updateColumn($col)
    {
        if ($col == 'finished') {
            $this->oneRun->finished ? $this->oneRun->finished = null : $this->oneRun->finished = now();

        } else {

            $this->oneRun->$col = !$this->oneRun->$col;

        }
        $this->oneRun->save();
    }

    public function mount()
    {
    }


    public function render()
    {
        return view('livewire.runs-table.row');
    }
}
