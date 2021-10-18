<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gate;

class VehicleController extends Controller
{

    public function index()
    {
        return view("vehicle.myvehicles");
    }

    public function create()
    {
        return view("vehicle.addvehicle");
    }

    public function store(Request $request)
    {
        $request->validate([
            'newmake' => 'required|min:3',
            'newmodel' => 'required',
            'newmilage' => 'required|numeric',
            'newservice' => 'date',
            'newmot' => 'date',
            'newinsurance' => 'date',
            'newtax' => 'date'


        ]);

        return redirect(route('vehicles'));
    }


    public function show($vehID)
    {
        $vehicle = Vehicle::with('Runs')->findOrFail($vehID);
        Gate::authorize('own', $vehicle);
        return view('vehicle.vehicleDetails', ['vehicle' => $vehicle]);

    }

    private function getDataFromDvla($reg)
    {

        $response = Http::withHeaders([
            'x-api-key' => env('DVLA_API_KEY'),
            'Content-Type' => 'application/json'
        ])->acceptJson()->post(env("DVLA_API_URL"), [
            "registrationNumber" => $reg
        ]);
        return $response->json();
    }
}
