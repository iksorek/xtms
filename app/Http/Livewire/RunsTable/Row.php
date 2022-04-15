<?php

namespace App\Http\Livewire\RunsTable;

use App\Models\Customer;
use Livewire\Component;

class Row extends Component
{

    public $oneRun, $customers, $search, $pickedCustomer, $update, $showDetails;
    public string $mode;

    public function addToDeleteRunArr($id)
    {
        $this->emit('addToDeleteRunArr', $id);
    }

    public function assignCustomerToRun($id)
    {
        $this->oneRun->customer_id = $id;
        $this->pickedCustomer = Customer::findOrFail($id)->name;
        $this->customers = null;
        $this->search = null;
        $this->oneRun->save();

    }


    public function detachCustomer()
    {

        $this->oneRun->customer_id = null;
        $this->pickedCustomer = null;
        $this->oneRun->save();

    }

    public function redirectToRun($run)
    {
        $this->redirectRoute('showRun', ['runId' => $run['id']]);
    }

    public function redirectToEditRun($run)
    {
        $this->redirectRoute('editRun', ['runId' => $run]);
    }

    private function setRunAsFinished()
    {
        $this->oneRun->finished = now();
        $this->oneRun->save();
        $this->oneRun->vehicle->mileage = $this->oneRun->vehicle->mileage + $this->oneRun->distance;
        $this->oneRun->vehicle->save();
    }

    private function setRunAsUnfinished()
    {
        $this->oneRun->finished = null;
        $this->oneRun->save();
        $this->oneRun->vehicle->mileage = $this->oneRun->vehicle->mileage - $this->oneRun->distance;
        $this->oneRun->vehicle->save();
    }

    public function updateColumn($col)
    {
        if ($col == 'finished') {
            $this->oneRun->finished ? $this->setRunAsUnfinished() : $this->setRunAsFinished();

        } else {

            $this->oneRun->$col = !$this->oneRun->$col;

        }
        $this->oneRun->save();
    }


    public function render()
    {
        if ($this->search != '' && !empty($this->search)) {
            $this->customers = Customer::where('user_id', \Auth::id())->where('name', 'LIKE', "%$this->search%")->get(['id', 'name']);
        }
        return view('livewire.runs-table.row');
    }
}
