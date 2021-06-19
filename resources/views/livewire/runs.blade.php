
<div class="p-5 w-full">
    <div class="container mx-auto mb-3">
        <x-jet-button class="w-full" wire:click="$toggle('addRun')">
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

                <x-jet-button class="mt-3 w-full" wire:click="getQuote">Get quote</x-jet-button>
            </div>
            <div>

                @if($townStart && $townFinish && $distance && $time)
                    <h2>Your quote</h2>

                    From {{$townStart}} to {{$townFinish}}<br>
                    Distance {{$distance}} miles<br>
                    Time {{$time}} minutes<br>
                    Approximate cost: &pound;{{$costApr}}
                    <br>
                    <x-jet-button class="m-3 w-full" wire:click="$toggle('createRun')">Create run</x-jet-button>





                @endif

            </div>


        </div>


        @if($createRun)
            <div class="flex items-center justify-center">
                <div class="w-full container mx-auto bg-gray-400 lg:rounded-3xl lg:p-5">
                    <livewire:new-run :newrun="$arrayResponse"/>
                </div>
            </div>
        @endif








    @else
        <div class="container mx-auto">
            <livewire:runs-table/>
        </div>

    @endif

</div>
