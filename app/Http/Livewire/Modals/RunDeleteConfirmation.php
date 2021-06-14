<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

class RunDeleteConfirmation extends Component
{
    public $run;

    public function hideDeleteModal()
    {
        $this->emit('hideDeleteModal');
    }

    public function deleteRun()
    {
        $this->run->delete();
        request()->session()->flash('flash.banner', 'Run deleted.');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect(route('runs'));
    }

    public function render()
    {
        return view('livewire.modals.run-delete-confirmation');
    }
}
