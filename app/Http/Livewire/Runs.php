<?php

namespace App\Http\Livewire;

use App\Models\Run;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Runs extends Component
{

    public $time, $distance, $townStart, $townFinish, $costApr;
    public $addRun = false;
    public $createRun = false;
    public $postcodesStart = 'np165ra';
    public $postcodesFinish = 'SW1A 0AA';
    public $arrayResponse;

    protected $listeners = [
        "refreshParent" => '$refresh',
    ];

    public function cancelAdding()
    {
        return $this->redirectRoute('runs');
    }

    public function calculateRoute()
    {
        $this->arrayResponse = getQuote($this->postcodesStart, $this->postcodesFinish);
        $this->time = $this->arrayResponse['time'];
        $this->distance = $this->arrayResponse['distance'];
        $this->townStart = $this->arrayResponse['townStart'];
        $this->townFinish = $this->arrayResponse['townFinish'];
        $this->costApr = $this->arrayResponse['costApr'];
        $this->distance = $this->arrayResponse['distance'];

    }

    public function render()
    {
        return view('livewire.runs');
    }


}
