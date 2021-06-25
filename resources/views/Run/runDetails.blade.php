<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            Run Details
        </h2>
        
    </x-slot>

    <div class="container mx-auto grid md:grid-cols-2 lg:grid-cols-3">
        <div class="run_details">
            <div class="run__title-top">Route</div>
            <div class="description">Postcodes: {{$run->postcode_from}} - {{$run->postcode_to}}</div>
            <div class="description">Customer: {{$run->Customer ? $run->Customer->name : 'Not set'}}</div>
            <div class="description">Vehicle: {{$run->Vehicle ? $run->Vehicle->reg : 'Not set'}}</div>
        </div>

        <div class="run_details">
            <div class="run__title-top">Cost</div>
            <div class="description">Final cost: {{$run->price ? $run->price : 'Not set'}}
                ({{$run->paid ? 'Paid' : 'Unpaid'}})
            </div>
            <div class="description">Distance: {{$run->distance ? "$run->distance miles" : 'Not set'}}</div>
            <div class="description">{{$run->finished ? "Finished at $run->finished" : 'Unfinished' }}</div>

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


        </div>
        @if($run->additional_info)
            <div class="run_details">
                <div class="run__title-top">Infos</div>
                <div class="description">{{$run->additional_info}}</div>
            </div>
        @endif
    </div>


</x-app-layout>
