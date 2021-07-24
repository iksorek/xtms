<div>


    <select wire:model="daysToCount">
        <option value="7">One week</option>
        <option value="14">Two weeks</option>
        <option value="30">Month</option>
    </select>
    <p> Showing planner for  {{ $daysToCount }} days
    </p>
    @foreach($dates as $day)

        <x-runs.day :day=$day />
    @endforeach
</div>
