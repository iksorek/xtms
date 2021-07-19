<?php

namespace App\View\Components\runs;

use Illuminate\View\Component;

class editIcon extends Component
{

   public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }


    public function render()
    {
        return view('components.runs.edit-icon');
    }
}
