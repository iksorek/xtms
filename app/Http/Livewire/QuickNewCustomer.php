<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Cassandra\Custom;
use Livewire\Component;
use Auth;

class QuickNewCustomer extends Component
{
    public $name, $mobile, $address, $info, $newCustomer;

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
        $this->emit('assignCustomer', $this->newCustomer->id);

    }


    public function render()
    {
        return view('livewire.quick-new-customer');
    }
}
