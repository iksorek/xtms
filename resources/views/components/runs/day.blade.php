<div class="flex bg-gray-200 my-1 text-xsm md:text-sm border border-gray-300">

    <div class="h-full border border-r m-1 bg-gray-300 p-2 flex-shrink-0 border border-gray-400 shadow-md">
        <p> {{date("l", strtotime($day))}}</p>
        <p>{{$day}} </p>
    </div>
    <div class="w-full p-2">
        @forelse($vehicles as $vehicle)
            <div class="w-full my-5 border border-black border-dotted pb-5">
                <p class="dashboard-title__top">{{$vehicle->reg}} {{$vehicle->make}}
                    - {{$vehicle->model}}</p>
                @if(isset($schedulerErr->veh)  && $schedulerErr->veh == $vehicle->id)
                    <p class="text-xl text-center bg-red-600 rounded-sm m-2">{{$schedulerErr->desc}}</p>
                @endif
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full">

                    @foreach($vehicle->Runs as $oneRun)
                        <div class="m-1 p-2
                         border border-2 relative shadow-md {{$oneRun->finished ? 'bg-green-400' : 'bg-blue-400'}}"
                             wire:click="setModal({{$oneRun->id}})">
                            <div class="absolute top-1 right-0.5 flex">
                                <x-runs.edit-icon :id="$oneRun->id"/>
                                <x-runs.view-icon :id="$oneRun->id"/>
                            </div>
                            <div class="absolute bottom-1 right-0.5 flex">
                                <p class="bg-yellow-200 px-1">{{$oneRun->status}}</p>
                            </div>


                            <div class="pr-10">
                                <p>{{$oneRun->postcode_from}} to {{$oneRun->postcode_to}}</p>
                                <p>{{substr($oneRun->start_time, -8)}} - {{substr($oneRun->finish_est, -8)}}
                                    {{$oneRun->back_est ? "(".substr($oneRun->back_est, -8).")" : 'No Estimates'}}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        @empty
            @if($mode != 'requested')
                <div class="h-20 p-2 flex">
                    <p class="run__info-big">No fully planned runs yet</p>
                </div>
            @endif

        @endforelse
        <div class="w-full">
            @if($runsWithoutVehicle->count() != 0)

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full">
                    @forelse($runsWithoutVehicle as $run)
                        <div class="m-1 border border-2 bg-yellow-400 p-2 relative shadow-md">
                            <div class="absolute top-1 right-0.5 flex">
                                <x-runs.edit-icon :id="$run->id"/>
                                <x-runs.view-icon :id="$run->id"/>
                            </div>
                            <div class="absolute bottom-1 right-0.5 flex">
                                <p class="bg-yellow-200 px-1">{{$run->status}}</p>
                            </div>
                            <div class="pr-10">
                                <p>{{$run->postcode_from}} to {{$run->postcode_to}}</p>
                                <p>
                                    {{substr($run->start_time, -8)}} - {{substr($run->finish_est, -8)}}

                                </p>
                                <p class="run_details_missing_badge">{{$run->customer_id ? $run->Customer->name : 'No customer'}}
                                    <br> {{$run->vehicle_id ? $run->Vehicle->reg : 'No vehicle'}}</p>
                            </div>


                        </div>
                    @empty
                        All run assigned to vehicle.
                    @endforelse
                </div>
            @endif
        </div>

    </div>


</div>


