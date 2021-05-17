<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerList extends Component

{
    public $search = null;
    public $customerDetails = null;
    public $customers = null;


    public function getCustomerDetails($id)
    {
        $this->customerDetails = Customer::where('id', $id)->firstOrFail();
    }


    public function render()
    {
        if($this->search == ''){
            $this->customerDetails = null;
        }
        if ($this->search != '' && !empty($this->search)) {
            $this->customers = Customer::where('user_id', \Auth::id())->where('name', 'LIKE', "%$this->search%")->get();
        } else {

            $this->customers = Customer::where('user_id', \Auth::id())->get();
        }

        return view('livewire.customer-list');
    }
}
