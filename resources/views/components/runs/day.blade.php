<div class="flex bg-blue-300 my-1 text-xsm md:text-sm">

    <div class="h-20 m-1 bg-blue-200 p-2 flex-shrink-0">
        <p>{{$day}}</p>
    </div>
    <div class="w-full p-2">
        @forelse($vehicles as $vehicle)
            <div class="border border-2 w-full m-1 p-2">
                <div class="w-full font-bold text-center">{{$vehicle->reg}} {{$vehicle->make}}
                    - {{$vehicle->model}}</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full">

                    @foreach($vehicle->Runs as $oneRun)
                        <div class="mx-1 p-2
                         border border-2 relative"
                             wire:click="redirectToRunDetails({{$oneRun}})">
                            <x-runs.edit-icon :id="$oneRun->Vehicle->id"/>
                            <p>{{$oneRun->postcode_from}} to {{$oneRun->postcode_to}}</p>
                            <p>{{substr($oneRun->start_time, -8)}} - {{substr($oneRun->finish_est, -8)}}
                                ({{substr($oneRun->back_est, -8)}})</p>
                        </div>
                    @endforeach

                </div>
            </div>

        @empty
            <div class="inline-block h-20 m-1 bg-blue-400 p-2">
                <p>No runs fully planned yet</p>
            </div>
        @endforelse
        <div class="border border-2 w-full m-1 p-2">
            <div class="w-full font-bold text-center">Not assigned or requested}</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full">
                @forelse($runsWithoutVehicle as $run)
                    <div class="mx-1 border border-2 bg-red-400 p-2 relative"
                         wire:click="redirectToRunDetails({{$run->id}})">

                        <div class="relative">
                            <p>{{$run->postcode_from}} to {{$run->postcode_to}}</p>
                            <p>{{substr($run->start_time, -8)}} - {{substr($run->finish_est, -8)}}
                                ({{substr($run->back_est, -8)}})</p>
                        </div>

                        <x-runs.edit-icon :id="$run->id"/>


                    </div>
                @empty
                    All run assigned to vehicle.
                @endforelse
            </div>
        </div>
    </div>


</div>


