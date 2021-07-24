<?php

namespace App\Http\Livewire;

use App\Models\Run;
use Livewire\Component;

class RunsBlocks extends Component
{

    public $daysToCount;
    public $today, $lastDay, $dates;

    public function mount()
    {
        if ($this->daysToCount || ($this->daysToCount = 7)) {
            $this->today = new \DateTime('now');
        }
        for ($i = 0; $i < $this->daysToCount; $i++) {
            $this->today = new \DateTime('now');
            $this->dates[] = $this->today->modify("+$i days")->format('Y-m-d');
        }

    }

    public function redirectToRunDetails(Run $run)
    {
        $this->redirectRoute('showRun', $run);
    }


    public function setDaysToCount($val)

    {
        $this->dates = null;
        $this->daysToCount = $val;
        for ($i = 0; $i < $val; $i++) {
            $this->today = new \DateTime('now');
            $this->dates[$i] = $this->today->modify("+$i days")->format('Y-m-d');
        }

    }

    public function render()
    {
        return view('livewire.runs-blocks');
    }
}
