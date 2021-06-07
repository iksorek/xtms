<?php

namespace App\Http\Livewire;

use App\Models\Run;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Runs extends Component
{

    public $myRuns, $time, $distance, $townStart, $townFinish, $costApr;
    public $addRun = false;
    public $postcodesStart = 'np165ra';
    public $postcodesFinish = 'SW1A 0AA';


    public function getMyRuns()
    {
        $this->postcodeToCoordinates('np165ra');
        return Run::where('user_id', \Auth::id())->get();
    }

    public function mount()
    {
        $this->myRuns = $this->getMyRuns();
    }

    public function postcodeToCoordinates($postcode)
    {
        $response = Http::get(env('POSTCODES_API_URL') . $postcode);
        return $response->json('result');

    }

    public function getQuote()
    {

        $coordinatesStart = $this->postcodeToCoordinates($this->postcodesStart);
        $coordinatesFinish = $this->postcodeToCoordinates($this->postcodesFinish);
        $this->townStart = $coordinatesStart['parish'];
        $this->townFinish = $coordinatesFinish['parish'];
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
        $this->time = $response->json()['routes'][0]['summary']['duration'] / 60;
        $this->distance = round($response->json()['routes'][0]['summary']['distance']);

        $this->costApr = ($this->distance * 1.3) + ($this->time / 60 * 12);
        //lets say cost per mile = GBP1.3 PLUS GBP12 per hour. Will be added in settings
        //todo ADD SETTINGS to be able to set cost per mile / hour

    }

    public function render()
    {
        return view('livewire.runs');
    }


}
