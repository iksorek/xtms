<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{

    public function quote(Request $request)
    {
        if (!empty($request->postcode_from) && !empty($request->postcode_to)) {
            return getQuote($request->postcode_from, $request->postcode_to, $request->api_key);

        } else {
            return response('Invalid postcodes', 400);
        }
    }

    public function request(Request $request)
    {

        $provider = User::where('api_key', $request->api_key)->firstOrFail();
        $requestedRun = $provider->Runs()->create([
            'postcode_from' => $request->postcode_from,
            'postcode_to' => $request->postcode_to,
            'start_time' => $request->pickupdate,
            'price' => $request->price,
            'status' => 'requested',
            'additional_info' => $request->customer_name . ' tel.' . $request->customer_contact

        ]);

        return response($requestedRun->only('created_at'), 201);

    }

}
