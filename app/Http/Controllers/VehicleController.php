<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\View\Components\vehicleDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        return view('vehicle.vehicleDetails', ['vehicle'=>$vehicle]);
    }

    public function edit(vehicle $vehicle)
    {
        //
    }

    public function update(Request $request, vehicle $vehicle)
    {
        //
    }


    public function destroy(vehicle $vehicle)
    {
        //
    }

    public function getDataFromDvla($reg)
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
