<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Element;

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
            'newmake'=>'required|min:3',
            'newmodel'=>'required',
            'newmilage'=>'required|numeric',
            'newservice'=>'date',
            'newmot'=>'date',
            'newinsurance'=>'date',
            'newtax'=>'date'


        ]);

        return redirect(route('vehicles'));
    }


    public function show($vehID)
    {
        $vehicle = Vehicle::with('Runs')->findOrFail($vehID);
        if (auth()->user()->Vehicles()->where('id', $vehID)->exists() || auth()->user()->hasRole('admin')) {
            return view('vehicle.vehicleDetails', ['vehicle' => $vehicle]);
        }
        else {
            abort(403);
        }
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
