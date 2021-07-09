<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Mysettings extends Component
{
    public $ppm, $pph;

    protected $rules = [
        'ppm' => 'required|numeric',
        'pph' => 'required|numeric'
    ];

    public function updateSettings()
    {
        $this->validate();
        $user = Auth::user();

        $user->ppm = $this->ppm;
        $user->pph = $this->pph;
        $user->save();
//        $this->redirect(route('mysettings'));


    }


    public function mount()
    {
        $this->pph = Auth::user()->pph;
        $this->ppm = Auth::user()->ppm;
    }


    public function render()
    {
        return view('livewire.mysettings');
    }
}
