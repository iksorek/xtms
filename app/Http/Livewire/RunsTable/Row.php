<?php

namespace App\Http\Livewire\RunsTable;

use App\Models\Customer;
use Livewire\Component;

class Row extends Component
{

    public $oneRun, $customers, $search, $pickedCustomer, $update;

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
        if ($this->search != '' && !empty($this->search)) {
            $this->customers = Customer::where('user_id', \Auth::id())->where('name', 'LIKE', "%$this->search%")->get(['id', 'name']);
        }
        return view('livewire.runs-table.row');
    }
}
