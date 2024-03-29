<div class="relative">
    <x-jet-confirmation-modal wire:model="delete" class="text-black">
        <x-slot name="title">
            <span class="text-yellow-600">Delete run</span>
        </x-slot>
        <x-slot name="content">
            <span class="text-gray-900">You are about to delete run from {{ $run ? $run->postcode_from : 'Err'}} to
            {{ $run ? $run->postcode_to : 'Err'}}<br>

            Are You sure?</span>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('delete')">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteRun({{$run}})">
                DELETE
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    @if($showCustomerDetails)
        <div class="customer_details text-white">
            <h2 class="text-center">{{$run->Customer->name}}</h2>

            <p class="inline-flex text-lg font-bold">
                <x-bx-mobile class="h-6"/>{{$run->Customer->mobile}}
            </p>
            <address>
                {{$run->Customer->address}}
            </address>
            <p class="mt-3">
                {{$run->Customer->info}}
            </p>


            <x-jet-button wire:click="$toggle('showCustomerDetails')" class="mt-4">Close</x-jet-button>
        </div>
    @endif

    <div class="mx-auto grid md:grid-cols-2 lg:grid-cols-3">


        <div class="run_details">
            <div class="run__title-top">Route</div>
            <div class="description">
                <p>Postcodes</p>
                <p>{{$run->postcode_from}} - {{$run->postcode_to}}</p></div>
            @if($run->address_from || $run->long_from || $run->lat_from)
                <div class="description"><p>Pick up address: </p>
                    <p>{{$run->address_from}}</p>
                    <p>Long{{$run->long_from}}</p>
                    <p>Lat{{$run->lat_from}}</p>
                </div>
            @endif
            @if($run->address_to || $run->long_to || $run->lat_to)
                <div class="description">
                    <p>
                        Drop off address:
                    </p>
                    <p>{{$run->address_to}}</p>
                    <p>Long{{$run->lat_to}}</p>
                    <p>Lat{{$run->long_to}}</p>
                </div>

            @endif

            @if($run->Customer)
                <p class="description cursor-pointer" wire:click="$toggle('showCustomerDetails')">
                    Customer: {{$run->Customer->name}}</p>
            @else
                <div class="description">
                    <p>Customer: </p>
                    <p>Not set</p>
                </div>
            @endif

            <p class="description">Vehicle: {{$run->Vehicle ? $run->Vehicle->reg : 'Not set'}}</p>


        </div>

        <div class="run_details">
            <div class="run__title-top">Cost</div>
            <div class="description">Final cost: {{$run->price ? $run->price : 'Not set'}}
                <span class="button-like-link" wire:click="togglePaid">{{$run->paid ? 'Paid' : 'Unpaid'}}
                    </span>
            </div>
            <div class="description">
                Distance: {{$run->distance ? "$run->distance miles" : 'Not set'}}</div>

        </div>
        <div class="run_details">
            <div class="run__title-top">Dates</div>
            <div class="description has-tooltip">Start: {{$run->start_time}}
                @if($run->start_time > NOW())
                    <span class='tooltip text-green-500 rounded shadow-lg px-1 bg-gray-100'>
                {{\Carbon\Carbon::parse($run->start_time)->diffForHumans()}} left
                </span>

                @else
                    <span class='tooltip text-green-500 rounded shadow-lg px-1 bg-gray-100'>
                {{\Carbon\Carbon::parse($run->start_time)->diffForHumans()}}
                </span>
                @endif
            </div>


            <div class="description has-tooltip">Finish EST: {{$run->finish_est}}
                @if($run->start_time > NOW())
                    <span class='tooltip text-green-500 rounded shadow-lg px-1 bg-gray-100'>
                {{\Carbon\Carbon::parse($run->finish_est)->diffForHumans()}} left
                </span>

                @else
                    <span class='tooltip text-green-500 rounded shadow-lg px-1 bg-gray-100'>
                {{\Carbon\Carbon::parse($run->finish_est)->diffForHumans()}}
                </span>
                @endif
            </div>


            <div class="description has-tooltip">Back EST: {{$run->back_est}}
                @if($run->start_time > NOW())
                    <span class='tooltip text-green-500 rounded shadow-lg px-1 bg-gray-100'>
                {{\Carbon\Carbon::parse($run->back_est)->diffForHumans()}} left
                </span>

                @else
                    <span class='tooltip text-green-500 rounded shadow-lg px-1 bg-gray-100'>
                {{\Carbon\Carbon::parse($run->back_est)->diffForHumans()}}
                </span>
                @endif</div>
            @if($run->finished != null)
                <span>
                Finshed at: {{$run->finished}}
            </span>
            @else
                <span class="button-like-link" wire:click="setAsFinished">Finish now</span>
            @endif

        </div>
        @if($run->additional_info)
            <div class="run_details">
                <div class="run__title-top">Infos</div>
                <div class="description">{{$run->additional_info}}</div>
            </div>
        @endif


        <div class="run_details">
            <div class="run__title-top">Status</div>
            <livewire:run-status-change-buttons :run="$run"/>
        </div>
        <div class="run_details">
            <div class="run__title-top">Options</div>
            <span><a href="{{route('editRun', $run)}}" class="button-like-link">Edit run</a></span>
            <span class="button-like-link cursor-pointer" wire:click="$toggle('delete')">Delete</span>
        </div>
        <div class="run_details">
            <div class="run__title-top">Notes</div>
            <div class="description">{{$run->notes}}</div>
        </div>
        @if($run->long_to && $run->lat_to && $run->long_from && $run->lat_from)
            <div class="run_details">
                <div class="run__title-top">Map</div>
                <div class="description">
                    <div id="map">

                        <x-ors-map :geo="$run"/>
                    </div>


                </div>
            </div>
        @endif
    </div>
</div>
