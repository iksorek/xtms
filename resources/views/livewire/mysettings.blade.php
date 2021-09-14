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
        <h3>API quick guide</h3>
        <div class="api_doc_part">
            <p>Quotes URL: https://xtms.uk/api/quote</p>
            <p>Method: POST</p>
            <p>Sample JSON body:
            <pre>
    {
    "api_key": "{{auth()->user()->api_key}}",
    "postcode_from": "np165ra",
    "postcode_to": "SG156RY"
    }
            </pre>
            </p>
            <p>Sample JSON response:
            <pre>
    {
    "townStart": "Chepstow",
    "townFinish": "Arlesey",
    "time": 162, <span class="text-gray-600">//minutes</span>
    "distance": 157,  <span class="text-gray-600">//miles</span>
    "postcodesStart": "NP16 5RA",
    "postcodesFinish": "SG15 6RY",
    "costApr": 380 <span class="text-gray-600">//approx cost in GBP</span>
    }
            </pre>
            </p>
        </div>

        <div class="api_doc_part">
            <p>Run request URL: https://xtms.uk/api/request</p>
            <p>Method: POST</p>
            <p>Sample JSON body:
            <pre>
    {
    "api_key": "{{auth()->user()->api_key}}",
    "postcode_from": "np165ra",
    "postcode_to": "SG156RY"
    "pickupdate": "2021-10-21",
    "price": 380,
    "customer_name": "Batman",
    "customer_contact": "555-bat-man"
    }
            </pre>
            </p>
            <p>As response You should get JSON object with 'created_at' value only. Rest of the object is hidden for
                security reasons.</p>
            <p>
                Sample JSON response:
            <pre>
    {
    "created_at": "2021-09-12T11:44:13.000000Z",
    }
            </pre>
            </p>
        </div>
    </div>
</div>
