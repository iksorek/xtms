<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerList extends Component

{
    public $search = null;
    public $customerDetails = null;
    public $customers = null;
    public $confirmingCustomerDeletionModal = false;
    public $addNewCustomer = false;

    protected $listeners = ['hideNewCustomerModal'];

    public function hideNewCustomerModal(){
        $this->addNewCustomer = false;
    }

    public function getCustomerDetails($id)
    {
        $this->customerDetails = Customer::where('id', $id)->firstOrFail();
    }

    public function confirmingCustomerDeletion($id)
    {
        $this->confirmingCustomerDeletionModal = true;

    }

    public function deleteCustomer($id)
    {
        Customer::findOrFail($id)->delete();
        request()->session()->flash('flash.banner', 'Customer deleted');
        request()->session()->flash('flash.bannerStyle', 'danger');
        return redirect()->to(route('myCustomers'));
    }

    public function render()
    {
        if ($this->search == '') {
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
