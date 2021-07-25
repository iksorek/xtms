<div>
    <div class="grid grid-cols-1 md:grid-cols-2 place-items-center">
        <div class="m-3 md:m-10">
            <x-jet-label>Price per mile</x-jet-label>
            <x-jet-input name="ppm" wire:model="ppm"/>
            <x-jet-input-error for="ppm"/>
        </div>
        <div>
            <x-jet-label>Price per hour</x-jet-label>
            <x-jet-input name="pph" wire:model="pph"/>
            <x-jet-input-error for="pph"/>
        </div>

    </div>
    <div class="grid place-items-center">
        <x-jet-button type="submit" class="my-3 md:my-10 md:w-3/4" wire:click="updateSettings">Save changes</x-jet-button>
    </div>
</div>