<div class="flex flex-col w-3/4 p-10 align-middle">


    <x-jet-label for="reg">New vehicle registration</x-jet-label>
    <x-jet-input nam="reg" disabled="{{$make}}" wire:model="reg"
                 placeholder="New vehicle registration"></x-jet-input>
    <x-jet-button class="mt-3" wire:click="checkReg">Check</x-jet-button>
    @if($make && $make != 'err')
        <div class="m-10">
            <x-jet-label for="make">Make</x-jet-label>
            <x-jet-input name="make" value="{{$make}}"/>
            <x-jet-input-error for="make"/>

            <x-jet-label for="model">Model</x-jet-label>
            <x-jet-input name="model" wire:model="model"/>
            <x-jet-input-error for="model"/>

            <x-jet-label for="mileage">Current mileage</x-jet-label>
            <x-jet-input name="mileage" type="number" wire:model="mileage"/>
            <x-jet-input-error for="mileage"/>

            <x-jet-label for="service">Next service mileage</x-jet-label>
            <x-jet-input name="service" type="number" wire:model="service"/>
            <x-jet-input-error for="service"/>

            <x-jet-label for="mot">MOT retest date</x-jet-label>
            <x-jet-input name="mot" wire:model="mot" type="date"/>
            <x-jet-input-error for="mot"/>

            <x-jet-label for="insurance">Insurance renewal date</x-jet-label>
            <x-jet-input name="insurance" type="date" wire:model="insurance"/>
            <x-jet-input-error for="insurance"/>

            <x-jet-label for="tax">Tax due date</x-jet-label>
            <x-jet-input name="tax" type="date" wire:model="tax"/>
            <x-jet-input-error for="tax"/>
            <br>
            <x-jet-button wire:click="storeNewVehicle" class="mt-3 w-1/4">Save</x-jet-button>


        </div>


    @endif
</div>
