<div class="">
    <div class="mb-3">

        @if(!$addRun)
            <x-jet-button wire:click="$toggle('addRun')">ADD RUN</x-jet-button>
        @else
            <x-jet-button wire:click="cancelAdding" class="bg-red-500 hover:bg-red-700">Cancel</x-jet-button>
        @endif

    </div>


    @if($addRun)
        <div class="grid grid-cols-1 md:grid-cols-2">

            <div class="bg-gray-300 p-2">
                <x-jet-label for="reg">Where do we start our journey</x-jet-label>
                <x-jet-input wire:model="postcodesStart"
                             placeholder="Postcode from"></x-jet-input>
                <x-jet-input-error for="postcodesStart"/>
                <x-jet-label for="reg">Where do we go</x-jet-label>
                <x-jet-input wire:model="postcodesFinish"
                             placeholder="Postcode from"></x-jet-input>
                <x-jet-input-error for="postcodesFinish"/>
                <br>

                <x-jet-button class="mt-3" wire:click="calculateRoute">Get quote</x-jet-button>
            </div>

            @if($townStart &&  $distance && $time)
                <div class="bg-gray-300 p-2">
                    <h2 class="font-bold">Your quote:</h2>

                    From {{$townStart}} to {{$townFinish}}<br>
                    Distance: {{$distance}} miles<br>
                    Time: {{$time}} minutes<br>
                    Approximate cost: &pound;{{$costApr}}
                    <br>
                    <span class="text-sm">
            ({{$distance}} miles * {{Auth::user()->ppm}}per mile)
               +
                ({{round($time / 60, 2)}} h * {{Auth::user()->pph}} per hour)
           </span>
                    <br>
                    <x-jet-button class="m-3" wire:click="$toggle('createRun')">Create run</x-jet-button>

                </div>



            @endif
        </div>
    @endif




    @if($createRun)
        <div class="flex items-center justify-center">
            <div class="w-full container mx-auto bg-gray-200 p-2">
                <livewire:new-run :newrun="$arrayResponse"/>
            </div>
        </div>
    @endif

    @if(!$addRun)
        {{--        //ADDRUN == FALSE--}}
        <div>
            <livewire:runs-table/>
        </div>

    @endif

</div>
