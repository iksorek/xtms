<?php

namespace App\Http\Controllers;

use App\Models\Run;
use Illuminate\Http\Request;

class RunController extends Controller
{

    public function index()
    {
        return view('Run.runsIndex');
    }

    public function show($run)
    {
        $run = Run::with(['Customer', "Vehicle"])->findOrFail($run);
        return view('Run.runDetails', ["run" => $run]);
    }

    public function edit($run)
    {
        $run = Run::with(['Customer', "Vehicle"])->findOrFail($run);
        return view('Run.runEdit', ["run" => $run]);
    }
}
