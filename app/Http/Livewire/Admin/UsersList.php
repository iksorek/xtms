<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.users-list', ['users' => User::withCount(['Runs', 'Vehicles', "Customers"])->orderBy('created_at')->paginate(10)]);
    }
}
