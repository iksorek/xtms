<?php

namespace App\View\Components\Vans;

use Carbon\Carbon;
use Illuminate\View\Component;

class VanExpDate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $date;
    public $color;
    public $tooltip = '';

    public function __construct($type, $date)
    {
        $this->type = $type;
        $this->date = $date;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->type == 'SERVICE') {
            $this->tooltip = $this->date[0];
            if ($this->date[0] < $this->date[1]) {
                $this->color = 'red';
                $diff = $this->date[1] - $this->date[0];
                $this->tooltip .= ' (' . $diff . ' miles ago)';
            } else {
                $this->color = 'green';
                $diff = $this->date[0] - $this->date[1];
                if ($diff < 30) {
                    $this->color = 'yellow';
                }
                $this->tooltip .= ' (' . $diff . ' miles left)';
            }

        } else {
            $this->tooltip = $this->date;
            $diff = Carbon::parse($this->date)->diffInDays(Carbon::now());
            $this->tooltip .= ' '. $diff . ' days';
            if ($this->date < now()) {
                $this->color = 'red';
                $this->tooltip .= ' '.'ago';
            } else {
                $this->color = 'green';
                $this->tooltip .= ' '.'left';
                if($diff < 30){
                    $this->color = 'yellow';
                }

            }


        }


        return view('components.vans.van-exp-date');
    }
}
