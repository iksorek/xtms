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
        $users = User::withCount(['Runs', 'Vehicles', 'Customers'])->orderByDesc('created_at')->paginate(10);
        return view('livewire.admin.users-list', ['users' => $users]);
    }
}
