<x-jet-confirmation-modal>
    <x-slot name="title">
        Delete run
    </x-slot>

    <x-slot name="content"><p>

            You are about to delete run from {{$run->postcode_from}} to {{$run->postcode_to}}
            <br>
            on {{$run->start_time}} @if($run->customer_id) for {{$run->Customer->name}} @endif
        </p>
        <p>
            Are You sure?
        </p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="hideDeleteModal" wire:loading.attr="disabled">
            Cancel
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="deleteRun" wire:loading.attr="disabled">
            Delete run
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
