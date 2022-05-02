<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Run;
use Livewire\Component;

class RunsBlocks extends Component
{

    public $daysToCount, $updatedDayToCount;

    public $today, $lastDay, $dates, $showModal;
    protected $listeners = ['setModal'];
    protected $rules = [
        'daysToCount' => 'required|integer|min:1|max:100',
    ];

    public function setModal($run)
    {
        $this->showModal = Run::findOrFail($run);
    }

    public function hideModal()
    {
        $this->showModal = false;
    }

    public function assignCustomerToRun(Customer $customer, $run)
    {
        $run = Runs::findOrFail($run);
        $run->Customer = $customer;
        $run->save();
    }


    public function mount()
    {
        if ($this->daysToCount && $this->daysToCount > 100) {
            $this->daysToCount = 100;
        }

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
        $this->validate();
        if ($val > 100) {
            $this->daysToCount = 100;

        } else {
            $this->daysToCount = $val;
        }

        $this->dates = null;
//        $this->daysToCount = $val;
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
