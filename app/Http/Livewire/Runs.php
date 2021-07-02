<?php

namespace App\Http\Livewire;

use App\Models\Run;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Runs extends Component
{

    public $time, $distance, $townStart, $townFinish, $costApr;
    public $addRun = false;
    public $createRun = false;
    public $postcodesStart = 'np165ra';
    public $postcodesFinish = 'SW1A 0AA';
    public $arrayResponse;

    protected $listeners = [
        "refreshParent" => '$refresh',
    ];

    public function cancelAdding()
    {
        return $this->redirectRoute('runs');
    }

//    public function postcodeToCoordinates($postcode)
//    {
//        $response = Http::get(env('POSTCODES_API_URL') . $postcode);
//        return $response->json('result');
//
//    }

//    public function getQuote()
//    {
//
//        $coordinatesStart = postcodeToCoordinates($this->postcodesStart);
//        $coordinatesFinish = postcodeToCoordinates($this->postcodesFinish);
//        $this->townStart = $coordinatesStart['parish'];
//        $this->townFinish = $coordinatesFinish['parish'];
//        $response = Http::withHeaders(
//            [
//                'Accept' => "application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8",
//                "Authorization" => env('OPENROUTE_SERVICE_API_KEY'),
//                "Content-Type" => "application/json; charset=utf-8"
//            ]
//        )->post(env("OPENROUTE_SERVICE_API_URL"), [
//            "coordinates" => [[$coordinatesStart['longitude'], $coordinatesStart['latitude']], [$coordinatesFinish['longitude'], $coordinatesFinish['latitude']]],
//            'units' => 'mi'
//        ]);
//        $this->time = round($response->json()['routes'][0]['summary']['duration'] / 60);
//        $this->time = round($response->json()['routes'][0]['summary']['duration'] / 60);
//        $this->distance = round($response->json()['routes'][0]['summary']['distance']);
//
//        $this->costApr = round(($this->distance * 1.3) + ($this->time / 60 * 12));
//        //lets say cost per mile = GBP1.3 PLUS GBP12 per hour. Will be added in settings
//        //todo ADD SETTINGS to be able to set cost per mile / hour
//        $this->arrayResponse = (array)$this;
//
//
//    }
    public function calculateRoute()
    {
        $this->arrayResponse = getQuote($this->postcodesStart, $this->postcodesFinish);
        $this->time = $this->arrayResponse['time'];
        $this->distance = $this->arrayResponse['distance'];
        $this->townStart = $this->arrayResponse['townStart'];
        $this->townFinish = $this->arrayResponse['townFinish'];
        $this->costApr = $this->arrayResponse['costApr'];
        $this->distance = $this->arrayResponse['distance'];

    }

    public function render()
    {
        return view('livewire.runs');
    }


}
