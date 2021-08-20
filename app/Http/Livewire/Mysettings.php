<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Mysettings extends Component
{
    public $ppm, $pph;
    public string $api_key;

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
        create_banner('Changes has been saved');
        $this->redirectRoute('mysettings');


    }


    public function mount()
    {
        $this->pph = Auth::user()->pph;
        $this->ppm = Auth::user()->ppm;
        $this->api_key = Auth::user()->api_key;

    }


    public function render()
    {
        return view('livewire.mysettings');
    }
}
