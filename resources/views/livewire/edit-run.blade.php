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
        <x-jet-label for="customer">Customer</x-jet-label>
        <select name="customer" wire:model="customer">

            @if($customer)
                <option selected value="{{$customer->id}}" class="bg-green-500">{{$customer->name}}</option>
            @else
                <option selected value="">Not selected yet</option>

            @endif

            @foreach($customers as $oneCustomer)
                <option value="{{$oneCustomer->id}}">{{$oneCustomer->name}}</option>

            @endforeach
        </select>
        <x-jet-input-error for="customer"/>
    </div>
    <div class="run_edit-cell">
        <x-jet-label for="vehicle">Vehicle</x-jet-label>
        <select name="vehicle" wire:model="vehicle">

            @if($vehicle)
                <option selected value="{{$vehicle->id}}" class="bg-green-500">{{$vehicle->reg}}</option>
            @else
                <option selected value="">Not selected yet</option>
            @endif
            @foreach($vehicles as $oneVehicle)
                <option value="{{$oneVehicle->id}}">{{$oneVehicle->reg}}</option>
            @endforeach
        </select>
        <x-jet-input-error for="customer"/>
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

</div>
