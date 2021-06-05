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
        ADDING FORM
    @else

        @foreach($myRuns as $run)
            {{$run->postcode_from}} - {{$run->postcode_to}} <br>
        @endforeach
    @endif

</div>
