<?php

namespace App\Http\Livewire;

use App\Models\Run;
use Illuminate\Testing\ParallelTesting;
use Livewire\Component;

class RunStatusChangeButtons extends Component
{
    public Run $run;
    public string $status;


    public function setNewStatus($newstatus)
    {
        $this->run->status = $newstatus;
        $this->run->save();
        $this->status = $newstatus;

    }

    public function render()
    {
        $this->status = $this->run->status;
        return view('livewire.run-status-change-buttons');
    }
}
