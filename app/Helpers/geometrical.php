<?php

use Illuminate\Support\Facades\Http;
use App\Models\User;

if (!function_exists('postcodeToCoordinates')) {
    function postcodeToCoordinates($postcode)
    {
        $response = Http::get(env('POSTCODES_API_URL') . $postcode);
        if (!$response->successful()) {
            return response('No coordinates from API :(', 400);
        }
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
        if (!postcode_check($postcodesStart) || !postcode_check($postcodesFinish)) {
            return response('Invalid postcode', 405);

        }


            if (isset($postcodesStart) && isset($postcodesFinish) && postcode_check($postcodesStart) && postcode_check($postcodesFinish)) {
            $coordinatesStart = postcodeToCoordinates($postcodesStart);
            $coordinatesFinish = postcodeToCoordinates($postcodesFinish);
            $res['townStart'] = $coordinatesStart['parish'];
            $res['townFinish'] = $coordinatesFinish['parish'];

        } else {
            return response('invalid postcodes', 400,);
        }
        if ($coordinatesStart && $coordinatesFinish) {
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
                dd($response->json());
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
            }
        } else {
            $res = response('Can not connect to API', 400);
        }
        return $res;

    }
}
if (!function_exists('postcode_check')) {
    function postcode_check(&$toCheck): bool
    {
        $alpha1 = "[abcdefghijklmnoprstuwyz]";                          // Character 1
        $alpha2 = "[abcdefghklmnopqrstuvwxy]";                          // Character 2
        $alpha3 = "[abcdefghjkstuw]";                                   // Character 3
        $alpha4 = "[abehmnprvwxy]";                                     // Character 4
        $alpha5 = "[abdefghjlnpqrstuwxyz]";                             // Character 5
        $pcexp[0] = '^(' . $alpha1 . '{1}' . $alpha2 . '{0,1}[0-9]{1,2})([[:space:]]{0,})([0-9]{1}' . $alpha5 . '{2})?$';
        $pcexp[1] = '^(' . $alpha1 . '{1}[0-9]{1}' . $alpha3 . '{1})([[:space:]]{0,})([0-9]{1}' . $alpha5 . '{2})?$';
        $pcexp[2] = '^(' . $alpha1 . '{1}' . $alpha2 . '[0-9]{1}' . $alpha4 . ')([[:space:]]{0,})([0-9]{1}' . $alpha5 . '{2})?$';
        $pcexp[3] = '^(gir)([[:space:]]{0,})?(0aa)?$';
        $pcexp[4] = '^(bfpo)([[:space:]]{0,})([0-9]{1,4})$';
        $pcexp[5] = '^(bfpo)([[:space:]]{0,})(c\/o([[:space:]]{0,})[0-9]{1,3})$';
        $pcexp[6] = '^([a-z]{4})([[:space:]]{0,})(1zz)$';
        $pcexp[7] = '^(ai\-2640)$';
        $postcode = strtolower($toCheck);
        $valid = false;
        foreach ($pcexp as $regexp) {
            if (preg_match('/' . $regexp . '/i', $postcode, $matches)) {
                $postcode = strtoupper($matches[1]);
                if (isset($matches[3])) {
                    $postcode .= ' ' . strtoupper($matches[3]);
                }
                $postcode = preg_replace('/C\/O/', 'c/o ', $postcode);
                $valid = true;
                break;
            }
        }
        if ($valid) {
            $toCheck = $postcode;
            return true;
        } else {
            return false;
        }
    }
}
