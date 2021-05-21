<div>
    <x-jet-dialog-modal>
        <x-slot name="title">
            Vehicle details
        </x-slot>

        <x-slot name="content">
            HERE I WILL DISPLAY ALL VEH DETAILS IN MOBILE MODE :)
            ID: {{$vehicle}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="toggleModal(false)">
                Close
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
