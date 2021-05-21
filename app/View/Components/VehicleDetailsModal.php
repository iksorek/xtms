<?php

namespace App\View\Components;

use App\Models\Vehicle;
use Illuminate\View\Component;

class VehicleDetailsModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     *
     */
    public $vehicle;


    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $details = Vehicle::findOrFail($this->vehicle);
        return view('components.vehicle-details-modal', compact($details));
    }
}
