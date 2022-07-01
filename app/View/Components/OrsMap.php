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

    public string $src = 'https://maps.openrouteservice.org/#/directions';
    public string $mapAttr = '/Chepstow%20Close,Cardiff%20County,Wales,United%20Kingdom/Cardiff,Wales,United%20Kingdom/data/55,130,32,198,15,97,4,224,38,9,96,59,2,24,5,192,166,6,113,0,184,64,90,1,152,3,160,9,128,22,114,5,96,29,128,26,42,4,102,60,155,8,19,138,128,56,6,226,56,198,0,217,217,114,165,65,179,42,0,25,10,18,149,68,29,16,16,0,58,167,129,17,54,28,160,1,121,64,11,107,139,146,149,208,32,3,55,128,6,221,46,16,177,163,192,6,228,128,57,190,48,201,162,41,6,125,5,186,52,58,34,24,29,158,48,100,1,129,136,108,58,44,8,0,47,162,80,0/embed/en-us';

    public function __construct()
    {
        //
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
