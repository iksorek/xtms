<?php

namespace App\View\Components\Dash;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $requstedRuns;

    public function __construct()
    {

        $this->requstedRuns = Auth::user()->Runs()->where('status', '=', 'requested')->count('id');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash.notification-menu');
    }
}
