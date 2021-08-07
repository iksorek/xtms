<div>
    @if(!$newCustomer)
        <x-jet-label for="name">Name</x-jet-label>
        <x-jet-input type="text" name="name" wire:model="name"/>
        <x-jet-input-error for="name"/>

        <x-jet-label for="mobile">Mobile number</x-jet-label>
        <x-jet-input type="text" name="mobile" wire:model="mobile"/>
        <x-jet-input-error for="mobile"/>

        <x-jet-label for="address">Address</x-jet-label>
        <textarea class="form_laravel" name="address" wire:model="address"></textarea>
        <x-jet-input-error for="address"/>

        <x-jet-label for="info">Info</x-jet-label>
        <textarea class="form_laravel" name="info" wire:model="info"></textarea>
        <x-jet-input-error for="info"/>
        <br>
        <x-jet-button wire:click="saveNewCustomer">Save</x-jet-button>
    @else

        {{$fromNewRun ? $newCustomer->name : ''}}
    @endif

</div>
