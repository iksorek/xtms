<?php

namespace App\View\Components\Dash;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $menu;

    public function __construct()
    {
        if (Auth::user()->hasRole('admin')) {
            $this->menu = ['Admin' => 'admin'];
        } else {
            $this->menu = ['Dashboard' => 'dashboard', 'My Vehicles' => 'myvehicles', 'My Runs' => 'runs', 'My Settings' => 'mysettings'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash.menu')->with('menu', $this->menu);
    }
}
