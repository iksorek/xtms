<div>
    <div class="m-10 p-5">
        <x-jet-label for="reg">Registration number</x-jet-label>
        <x-jet-input name="reg" value="{{$reg}}" disabled/>
        <x-jet-input-error for="reg"/>

        <x-jet-label for="make">Make</x-jet-label>
        <x-jet-input name="make" wire:model="make" value="{{$make}}"/>
        <x-jet-input-error for="make"/>

        <x-jet-label for="model">Model</x-jet-label>
        <x-jet-input name="model" wire:model="model"/>
        <x-jet-input-error for="model"/>

        <x-jet-label for="mileage">Current mileage</x-jet-label>
        <x-jet-input name="mileage" type="number" wire:model="mileage"/>
        <x-jet-input-error for="mileage"/>

        <x-jet-label for="service">Next service mileage</x-jet-label>
        <x-jet-input name="service" type="number" wire:model="service"/>
        <x-jet-button wire:click="addIntervalMilesToService" class="ml">+6000 miles</x-jet-button>
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
        <x-jet-button wire:click="updateVehicle" class="mt-3 w-1/4">Update</x-jet-button>
        <x-jet-button wire:click="cancelChanges" class="mt-3 w-1/4">Cancel</x-jet-button>
        <br>
        <x-jet-button wire:click="$toggle('confirmingVehicleDeletion')" class="mt-3 bg-red-600 w-full">DELETE VEHICLE</x-jet-button>

        <x-jet-confirmation-modal wire:model="confirmingVehicleDeletion">
            <x-slot name="title">
                Delete vehicle
            </x-slot>

            <x-slot name="content">
                Are you sure you want to delete your vehicle {{$reg}}?
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingVehicleDeletion')" wire:loading.attr="disabled">
                    Cancel
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteVehicle" wire:loading.attr="disabled">
                    Delete Vehicle
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>


    </div>


</div>
