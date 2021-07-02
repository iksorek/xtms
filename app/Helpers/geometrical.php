<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('postcodeToCoordinates')) {
    function postcodeToCoordinates($postcode)
    {
        $response = Http::get(env('POSTCODES_API_URL') . $postcode);
        return $response->json('result');

    }
}


if (!function_exists('getQuote')) {
    function getQuote($postcodesStart, $postcodesFinish)
    {

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
        $res['time'] = round($response->json()['routes'][0]['summary']['duration'] / 60);
        $res['distance'] = round($response->json()['routes'][0]['summary']['distance']);
        $res['postcodesStart'] = $postcodesStart;
        $res['postcodesFinish'] = $postcodesFinish;
        $res['costApr'] = round(($res['distance'] * 1.3) + ($res['time'] / 60 * 12));
        //lets say cost per mile = GBP1.3 PLUS GBP12 per hour. Will be added in settings
        //todo ADD SETTINGS to be able to set cost per mile / hour
        return $res;
    }
}
