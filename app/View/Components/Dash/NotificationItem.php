<?php

namespace App\View\Components\Dash;

use Illuminate\View\Component;
use Route;

class NotificationItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $notification;
    public int $number;

    public function __construct($notification, $number = 0)
    {
        $this->notification = $notification;
        $this->number = $number;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash.notification-item');
    }
}
