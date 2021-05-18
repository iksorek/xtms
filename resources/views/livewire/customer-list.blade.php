<div class="flex w-full">
    <div class="flex-col w-1/2">
        <div class="m-4">
            <x-jet-label for="search">Search Your customers</x-jet-label>
            <x-jet-input wire:model="search" name="search" placeholder="Type customer name" class="w-3/4 mx-auto"/>
        </div>
        @isset($customers)
            <ul>
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
    <div class="w-1/2 text-center p-5 bg-green-200 rounded-2xl">
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
            </div>

        @endisset

    </div>
</div>
