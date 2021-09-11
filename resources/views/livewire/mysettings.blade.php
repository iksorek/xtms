<div>

    <div class="grid grid-cols-1 md:grid-cols-2 place-items-center">
        <div class="m-3 md:m-10">
            <x-jet-label>Price per mile</x-jet-label>
            <x-jet-input name="ppm" wire:model="ppm"/>
            <x-jet-input-error for="ppm"/>
        </div>
        <div>
            <x-jet-label>Price per hour</x-jet-label>
            <x-jet-input name="pph" wire:model="pph"/>
            <x-jet-input-error for="pph"/>
        </div>
        <div>
            <p>Your API KEY</p>
        </div>
        <div>
            <x-jet-input class="form" type="text" value="{{$api_key}}" disabled/>
        </div>
    </div>
    <div class="grid place-items-center">
        <x-jet-button type="submit" class="my-3 md:my-10 md:w-3/4" wire:click="updateSettings">Save changes
        </x-jet-button>
    </div>
    <div class="api_info">
        <h3>API info</h3>
        <p>Quotes URL: https://xtms.uk/api/quote</p>
        <p>Method: POST</p>
        <p>Sample body:
        <pre>
            {
                "api_key": "supersecretapikey",
                "postcode_from": "np165ra",
                "postcode_to": "SG156RY"
            }</pre>
        </p>
        <p>Sample response:
        <pre>
            {
            "townStart": "Chepstow",
            "townFinish": "Arlesey",
            "time": 162, <span class="text-gray-600">//minutes</span>
            "distance": 157,  <span class="text-gray-600">//miles</span>
            "postcodesStart": "NP16 5RA",
            "postcodesFinish": "SG15 6RY",
            "costApr": 380 <span class="text-gray-600">//approx cost in GBP</span>
            }</pre>
        </p>
    </div>
</div>
