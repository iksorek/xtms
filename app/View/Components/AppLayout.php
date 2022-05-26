<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{


    public function render()
    {
        $menu = ['Dashboard' => 'dashboard', 'My Customers' => 'myCustomers', 'My Vehicles' => 'myvehicles', 'My Runs' => 'runs', 'My Settings' => 'mysettings'];
        return view('layouts.appw', compact('menu'));
    }
}
