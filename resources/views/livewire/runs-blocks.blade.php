@if($showModal)
    <div class="w-full z-50 h-3/4 bg-gray-600 rounded-xl text-white p-5">
        <p class="text-center text-lg">Details of run no {{$showModal->id}}</p>
        <livewire:runs.run-details :run="$showModal"/>

        <div>
            <x-jet-button wire:click="hideModal">Close</x-jet-button>
        </div>
    </div>

@endif
<div>
    Show planner for:<br>
    <x-jet-button wire:click="setDaysToCount(7)" class="{{$daysToCount == 7 ? 'bg-red-600' : ''}}">
        7 Days
    </x-jet-button>
    <x-jet-button wire:click="setDaysToCount(14)" class="{{$daysToCount == 14 ? 'bg-red-600' : ''}}">
        14
        Days
    </x-jet-button>
    <x-jet-button wire:click="setDaysToCount(30)" class="{{$daysToCount == 30 ? 'bg-red-600' : ''}}">
        30
        Days
    </x-jet-button>
    @foreach($dates as $day)
        <x-runs.day :day=$day/>
    @endforeach
</div>


