<?php

use Illuminate\Support\Facades\Http;
use App\Models\User;

if (!function_exists('postcodeToCoordinates')) {
    function postcodeToCoordinates($postcode)
    {
        $response = Http::get(env('POSTCODES_API_URL') . $postcode);
        return $response->json('result');

    }
}


if (!function_exists('getQuote')) {
    function getQuote($postcodesStart, $postcodesFinish, $api_key = null)
    {
        if ($api_key != null) {
            $provider = User::where('api_key', $api_key)->get();
            if (count($provider) == 0) {

                return response('Wrong Api Key', 204);

            }

        }

        $coordinatesStart = postcodeToCoordinates($postcodesStart);
        $coordinatesFinish = postcodeToCoordinates($postcodesFinish);
        $res['townStart'] = $coordinatesStart['parish'];
        $res['townFinish'] = $coordinatesFinish['parish'];
        $response = Http::withHeaders(
            [
                'Accept' => "application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8",
                "Authorization" => env('OPENROUTE_SERVICE_API_KEY'),
                "Content-Type" => "application/json; charset=utf-8"
            ]
        )->post(env("OPENROUTE_SERVICE_API_URL"), [
            "coordinates" => [[$coordinatesStart['longitude'], $coordinatesStart['latitude']], [$coordinatesFinish['longitude'], $coordinatesFinish['latitude']]],
            'units' => 'mi'
        ]);
        if ($response->successful()) {
            $res['time'] = round($response->json()['routes'][0]['summary']['duration'] / 60);
            $res['distance'] = round($response->json()['routes'][0]['summary']['distance']);
            $res['postcodesStart'] = $postcodesStart;
            $res['postcodesFinish'] = $postcodesFinish;
            if (!$api_key) {
                $res['costApr'] = round(($res['distance'] * Auth::user()->ppm) + ($res['time'] / 60 * Auth::user()->pph));
            } else {
                $provider = \App\Models\User::where('api_key', $api_key)->first();
                $res['costApr'] = round(($res['distance'] * $provider->ppm) + ($res['time'] / 60 * $provider->pph));
            }
            ($res['costApr'] > 20) ?: $res['costApr'] = 20;

        } else {
            $res = dd('Can not connect to API');
        }
        return $res;
    }
}
