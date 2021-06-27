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
            class="form_laravel">


        @if($vehicles->count() == 1)
            <option value="null">SELECT LATER</option>
            @foreach($vehicles as $oneVehicle)
                <option value="{{$oneVehicle->id}}" selected>{{$oneVehicle->model}} - {{$oneVehicle->reg}}</option>
            @endforeach
        @elseif($vehicles->count() > 1)
            <option value="null">SELECT LATER</option>
            @foreach($vehicles as $oneVehicle)
                <option value="{{$oneVehicle->id}}">{{$oneVehicle->model}} - {{$oneVehicle->reg}}</option>
            @endforeach
        @else
            <option value="null" selected>YOU HAVE NO VEHICLES!</option>
        @endif
    </select>

    <x-jet-label for="date">Choose a date</x-jet-label>
    <x-jet-input name="date" type="date" wire:model="date"/>
    <x-jet-input-error for="date"/>

    <x-jet-label for="startTime">Choose a time</x-jet-label>
    <x-jet-input name="startTime" type="time" wire:model="startTime"/>
    <x-jet-input-error for="startTime"/>
    <br>
    <x-jet-label for="additional_info">Additional info</x-jet-label>
    <textarea class="form_laravel" name="additional_info" wire:model="additional_info"></textarea>
    <x-jet-input-error for="additional_info"/>
    <br>


    <x-jet-button wire:click="saveNewRun" class="w-3/4 mt-3">Save run</x-jet-button>


</div>
