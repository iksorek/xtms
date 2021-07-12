<div>
    <p> Showing planner for  {{ $daysToCount }} days
    </p>
    @foreach($dates as $day)

        <x-runs.day :day=$day />
    @endforeach
</div>
