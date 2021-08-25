<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/quote', function (Request $request) {

    if (!empty($request->postcode_from) && !empty($request->postcode_to)) {
        return getQuote($request->postcode_from, $request->postcode_to, $request->api_key);

    } else {
        return response('Invalid postcodes', 400);
    }
});
