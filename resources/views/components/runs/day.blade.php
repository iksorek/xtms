{{--<div class="flex bg-blue-300 h-30 my-1 overflow-x-auto text-xsm md:text-sm">--}}

{{--    <div class="h-20 min-w-6 m-1 bg-blue-200 p-2 flex-shrink-0">--}}
{{--        <p>{{$day}}</p>--}}
{{--    </div>--}}
{{--    @forelse($runs as $run)--}}
{{--        <div class="h-20 w-80 overflow-x-auto m-1 bg-blue-400 p-2 flex-shrink-0">--}}
{{--            <p> {{$run->postcode_from}} to {{$run->postcode_to}} for {{ $run->Customer->name }}--}}
{{--            </p>--}}
{{--            <p>--}}
{{--                Times: {{substr($run->start_time, -8)}} - {{substr($run->finish_est, -8)}}--}}
{{--                ({{substr($run->back_est, -8)}})--}}
{{--            </p>--}}
{{--            @if($run->Vehicle)--}}
{{--                <p>Planned vehicle: {{$run->Vehicle->reg}}</p>--}}
{{--                @endif--}}


{{--        </div>--}}
{{--    @empty--}}
{{--        <div class="inline-block h-20 m-1 bg-blue-400 p-2">--}}
{{--            <p>No runs planned yet</p>--}}
{{--        </div>--}}
{{--    @endforelse--}}

{{--</div>--}}

<div class="flex bg-blue-300 my-1 text-xsm md:text-sm">

    <div class="h-20 m-1 bg-blue-200 p-2 flex-shrink-0">
        <p>{{$day}}</p>
    </div>
    <div class="w-full">
        @forelse($runs as $run)
            <div class="h-20 border border-2 w-full overflow-x-auto m-1">
                <div class="w-full font-bold text-center">{{$run->reg}} {{$run->make}} - {{$run->model}}</div>
                <div class="flex">
                    @foreach($run->Runs as $oneRun)
                        <div class="mx-1 w-72 border border-2" wire:click="redirectToRunDetails({{$oneRun}})">
                            <p>{{$oneRun->postcode_from}} to {{$oneRun->postcode_to}}</p>
                            <p>{{substr($oneRun->start_time, -8)}} - {{substr($oneRun->finish_est, -8)}}
                                ({{substr($oneRun->back_est, -8)}})</p>
                        </div>
                    @endforeach
                </div>
            </div>

        @empty
            <div class="inline-block h-20 m-1 bg-blue-400 p-2">
                <p>No runs planned yet</p>
            </div>
        @endforelse
    </div>


</div>
