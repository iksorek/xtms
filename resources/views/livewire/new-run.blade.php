<div>
    <h2 class="text-2xl">Create new run</h2>

    <p class="font-bold m-3">Trip from {{$newrun['townStart']}} ({{$newrun['postcodesStart']}})
        to {{$newrun['townFinish']}}
        ({{$newrun['postcodesFinish']}})
    </p>
    <x-jet-label for="cost">Final cost: (GBP)</x-jet-label>
    <x-jet-input wire:model="cost" name="cost"/>
    <x-jet-input-error for="cost"></x-jet-input-error>
    <br>
    <x-jet-label for="vehicle">Choose vehicle</x-jet-label>
    <select name="vehicle" wire:model="vehicle"
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        @foreach($vehicles as $oneVehicle)
            <option value="{{$oneVehicle->id}}">{{$oneVehicle->model}} - {{$oneVehicle->reg}}</option>
        @endforeach

    </select>

    <x-jet-label for="date">Choose a date</x-jet-label>
    <x-jet-input name="date" type="date" wire:model="date"/>
    <x-jet-input-error for="date"/>

    <x-jet-label for="startTime">Choose a time</x-jet-label>
    <x-jet-input name="startTime" type="time" wire:model="startTime"/>
    <x-jet-input-error for="startTime"/>
    <x-jet-button wire:click="saveNewRun">Save run</x-jet-button>


</div>
