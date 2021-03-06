<?php

namespace App\Http\Controllers;

use App\Models\Run;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RunController extends Controller
{

    public function index()
    {

        return view('Run.runsIndex');
    }

    public function show($run)
    {
        if (auth()->user()->Runs()->find($run) || auth()->user()->hasRole('admin')) {
            $run = Run::with(['Customer', "Vehicle"])->findOrFail($run);
            return view('Run.runDetails', ["run" => $run]);

        } else {
            abort(403);
        }

    }

    public function edit($run)
    {
        if (auth()->user()->Runs()->find($run) || auth()->user()->hasRole('admin')) {
            $run = Run::with(['Customer', "Vehicle"])->findOrFail($run);
            return view('Run.runEdit', ["run" => $run]);
        } else {
            abort(403);
        }
    }
}
