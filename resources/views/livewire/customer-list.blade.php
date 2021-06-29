<div class="container mx-auto gap-4 grid grid-cols-1 md:grid-cols-2">
    <div>
        <div class="m-2">
            <x-jet-label for="search">Search Your customers</x-jet-label>
            <x-jet-input wire:model="search" name="search" placeholder="Type customer name" class="w-full mx-auto"/>
        </div>
        @isset($customers)
            <ul class="h-20 sm:h-30 md:h-60 overflow-y-scroll">
                @empty($search)
                    <p class="text-center m-5">You have {{$customers->count()}} saved customers.</p>
                @else

                    @foreach($customers as $customer)
                        <li class="hover:bg-blue-300 mx-3"
                            wire:click="getCustomerDetails({{$customer->id}})">{{$customer->name}}</li>
                    @endforeach
                @endempty
            </ul>

        @endisset

        @empty($customers)
            You have no saved customers Yet
        @endempty
    </div>
    <div {{$customerDetails ? '' : ''}} class="p-4 md:p-10">
        @empty($customerDetails)
            Click on customer name to see more details.
        @endempty
        @isset($customerDetails)


            <div>
                <p><b>Name:</b> {{$customerDetails->name}}</p>
                <p><b>Mobile:</b> {{$customerDetails->mobile}}</p>
                <p><b>Address:</b> {{$customerDetails->address}}</p>
                <p><b>Info:</b> {{$customerDetails->info}}</p>
                <p><b>Number of runs</b> {{$customerDetails->runs()->count()}}</p>
                <x-jet-button wire:click="confirmingCustomerDeletion({{$customer->id}})" class="mt-3 bg-red-600 w-1/2">DELETE Customer
                </x-jet-button>



            </div>

        @endisset

    </div>
    <x-jet-confirmation-modal wire:model="confirmingCustomerDeletionModal">
        <x-slot name="title">
            Delete customer
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your customer <b>{{$customerDetails ? $customerDetails->name : ''}}</b>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button  wire:loading.attr="disabled" wire:click="$toggle('confirmingCustomerDeletionModal')">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2"  wire:loading.attr="disabled" wire:click="deleteCustomer({{$customerDetails ? $customerDetails->id : ''}})">
                Delete customer
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
