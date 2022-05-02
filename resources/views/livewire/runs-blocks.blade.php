<div>
    Show planner for {{$daysToCount}} days:<br>
    <x-jet-input type="number" wire:model="daysToCount" max="100" maxlength="3"/>
    <x-jet-input type="button" class="button-like-link" wire:click="setDaysToCount({{$daysToCount}})" value="Update"/>

    @foreach($dates as $day)
        <x-runs.day :day=$day/>
    @endforeach
</div>


