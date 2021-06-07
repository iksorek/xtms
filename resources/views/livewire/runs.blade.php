<div class="p-5">
    <div class="text-right">
        <x-jet-button wire:click="$toggle('addRun')">
            @if(!$addRun)
                ADD RUN
            @else
                Hide Form
            @endif
        </x-jet-button>

    </div>


    @if($addRun)
        <div class="flex justify-evenly">
            <div>
                <x-jet-label for="reg">Where do we start our journey</x-jet-label>
                <x-jet-input wire:model="postcodesStart"
                             placeholder="Postcode from"></x-jet-input>
                <x-jet-input-error for="postcodesStart"/>
                <x-jet-label for="reg">Where do we go</x-jet-label>
                <x-jet-input wire:model="postcodesFinish"
                             placeholder="Postcode from"></x-jet-input>
                <x-jet-input-error for="postcodesFinish"/>
                <br>

                <x-jet-button class="mt-3" wire:click="getQuote">Get quote</x-jet-button>
            </div>
            <div>

                @if($townStart && $townFinish && $distance && $time)
                    <h2>Your quote</h2>

                    From {{$townStart}} to {{$townFinish}}<br>
                    Distance {{$distance}} miles<br>
                    Time {{round($time)}} minutes<br>
                    Approximate cost: &pound;{{round($costApr)}}


                @endif

            </div>

        </div>






    @else

        @foreach($myRuns as $run)
            {{$run->postcode_from}} - {{$run->postcode_to}} <br>
        @endforeach
    @endif


</div>
