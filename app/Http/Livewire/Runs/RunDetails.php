<?php

namespace App\Http\Livewire\Runs;

use App\Models\Customer;
use App\Models\Run;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class RunDetails extends Component
{
    public $run;
    public $delete;
    public $showCustomerDetails;




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

    public function setAsFinished()
    {
        $this->run->Vehicle->mileage = $this->run->Vehicle->mileage + ($this->run->distance * 2);
        $this->run->Vehicle->save();
        $this->run->finished = now();
        $this->run->save();
    }

    public function togglePaid()
    {
        $this->run->paid = !$this->run->paid;
        $this->run->save();
    }


    public function render()
    {


        return view('livewire.runs.run-details');
    }
}
