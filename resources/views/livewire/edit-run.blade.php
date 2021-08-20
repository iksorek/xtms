<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="run_edit-cell">
        <x-jet-label for="postcode_from">Starting point postcode</x-jet-label>
        <x-jet-input name="postcode_from" wire:model="postcode_from"/>
        <x-jet-input-error for="postcode_from"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="postcode_to">We are we going to</x-jet-label>
        <x-jet-input name="postcode_to" wire:model="postcode_to"/>
        <x-jet-input-error for="postcode_to"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="cost">Cost</x-jet-label>
        <x-jet-input name="cost" wire:model="cost"/>
        <x-jet-input-error for="cost"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="cost">Distance</x-jet-label>
        <div class="w-full inline-block">
            {{$distance ? $distance . " miles" : "Unknown yet"}}

        </div>
        <x-jet-input-error for="distance"/>
        <x-jet-button class="w-full h-8 my-auto" wire:click="recalculateRun">Recalculate cost and distance
        </x-jet-button>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="newCustomer">Customer</x-jet-label>


        <select name="newCustomer" class="form_laravel" wire:model="newCustomer">
            @if($customer)
                <option value="{{$customer->id}}" selected>{{$customer->name}}</option>

            @else
                <option value="0" selected>PLEASE SELECT</option>
            @endif
            @foreach($customers as $oneCustomer)
                <option value="{{$oneCustomer->id}}">{{$oneCustomer->name}}</option>
            @endforeach

        </select>


        <x-jet-input-error for="newCustomer"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="newVehicle">Vehicle</x-jet-label>
        <select name="newVehicle" class="form_laravel" wire:model="newVehicle">


            @if($vehicle)
                <option value="{{$vehicle->id}}" selected>{{$vehicle->name}}</option>

            @else
                <option value="0" selected>PLEASE SELECT</option>
            @endif
            @foreach($vehicles as $oneVehicle)
                <option
                    value="{{$oneVehicle->id}}" {{check_vehicle($oneVehicle->id) ? 'disabled' : ''}}>{{$oneVehicle->reg}}</option>
            @endforeach


        </select>
        <x-jet-input-error for="newVehicle"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="date">Date</x-jet-label>
        <x-jet-input name="date" type="date" wire:model="date"/>
        <x-jet-input-error for="date"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="startTime">Pickup time</x-jet-label>
        <x-jet-input name="startTime" type="time" wire:model="startTime"/>
        <x-jet-input-error for="startTime"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="additional_info">Additional info</x-jet-label>
        <textarea name="additional_info" class="form_laravel" wire:model="additional_info"></textarea>
        <x-jet-input-error for="additional_info"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="additional_info">Status</x-jet-label>
        <livewire:run-status-change-buttons :run="$run"/>
    </div>

    <div class="place-self-end">
        <x-jet-button wire:click="updateRun">Save changes</x-jet-button>
    </div>

</div>


