<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrsMap extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $geo;


    public function __construct($geo)
    {
        $this->geo = $geo;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.ors-map');
    }
}
