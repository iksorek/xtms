<div>

    <x-jet-input type="number" wire:model="daysToCount" max="100" maxlength="3"/>

    <x-jet-input type="button" class="button-like-link" wire:click="setDaysToCount({{$daysToCount}})"
                 :disabled="$daysToCount == ''" value="Update"/>
    @error('daysToCount') <p class="error">{{ $message }}</p>
    @else
        @if(is_int($daysToCount))
            <p>Showing planner for {{$daysToCount}} days:</p>
        @endif
        @enderror

        @foreach($dates as $day)
            <x-runs.day :day=$day :mode=$mode />
        @endforeach
</div>


