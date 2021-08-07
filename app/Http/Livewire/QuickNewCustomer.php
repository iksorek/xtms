<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Cassandra\Custom;
use Livewire\Component;
use Auth;

class QuickNewCustomer extends Component
{
    public $name, $mobile, $address, $info, $newCustomer;
    public $fromNewRun = false;

    protected $rules = [
        "name" => 'required|min:3',
        "mobile" => 'required|min:3',
    ];

    public function saveNewCustomer()
    {
        $this->validate();
        $this->newCustomer = Auth::user()->Customers()->create([
            'name' => $this->name,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'info' => $this->info,
        ]);
        if ($this->fromNewRun) {
            $this->emit('assignCustomer', $this->newCustomer->id);
        } else {
            create_banner('New customer '.$this->name.' added');
            $this->redirect(route('myCustomers'));
        }
    }


    public function render()
    {
        return view('livewire.quick-new-customer');
    }
}
