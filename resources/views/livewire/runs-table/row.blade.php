<tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Route</span>
        <span
            class="{{$oneRun->finished ? ' text-green-600' : ''}} font-bold uppercase cursor-pointer"
            wire:click="redirectToRun({{$oneRun}})">{{$oneRun->postcode_from}} - {{$oneRun->postcode_to}}</span>
    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-right lg:text-center border border-b block lg:table-cell relative lg:static">
        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Customer</span>
        <div class="sm:w-full w-1/2 mx-auto sm:pl-28">

            @if($oneRun->Customer && $oneRun->customer_id)
                <div class="flex justify-between w-50">
                    <div>{{$oneRun->Customer->name}}</div>
                    <div class="text-red-500 border border-red-500 px-1 mx-1" wire:click="detachCustomer">X</div>
                </div>

            @elseif($pickedCustomer)
                <div class="flex justify-between w-full">
                    <div>{{$pickedCustomer}}</div>
                    <div class="text-red-500 border border-red-500 px-1 mx-1" wire:click="detachCustomer">X</div>
                </div>

            @else
                <div class="flex flex-col">
                    <x-jet-input class="border" name="search" wire:model="search" value="Pick customer"/>

                    @empty($customers)
                        @if(empty($customers) && $search)
                            <p class="text-center m-5">Not found</p>
                        @endif
                    @else
                        <br>
                        <ul class="max-h-36 overflow-y-scroll position-fixed">
                            @foreach($customers as $customer)
                                <li class="hover:bg-blue-300 mx-3"
                                    wire:click="assignCustomerToRun({{$customer->id}})">{{$customer->name}}</li>
                            @endforeach
                        </ul>
                    @endempty

                </div>
            @endif

        </div>


    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase ">Times</span>
        <span class="{{$oneRun->finished ? ' text-green-600' : ''}}">
                Start {{$oneRun->start_time}}<br>
                Eta Finish {{$oneRun->finish_est}}<br>
                {{$oneRun->finished ? 'Finished: ' . $oneRun->finished : 'Back est: ' . $oneRun->back_est}}
    </span>

    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
        <button
            wire:click="updateColumn('paid')"
            class="{{$oneRun->paid ? 'bg-green-200' : 'bg-red-500'}} text-black py-1 px-3 rounded-full text-xs">{{$oneRun->paid ? 'Paid' : 'Unpaid'}}
            (&pound;{{$oneRun->price}})
        </button>
        <button
            wire:click="updateColumn('finished')"
            class="{{$oneRun->finished ? 'bg-green-200' : 'bg-red-200'}} py-1 px-3 rounded-full text-xs"

        >{{$oneRun->finished ? 'Finished' : 'Unfinished'}}

        </button>


    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
        <div class="flex item-center justify-center">
            <div class="actions_buttons"
                 wire:click="redirectToRun({{$oneRun}})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            @if($mode != 'deleted')
            <div class="actions_buttons"
                 wire:click="redirectToEditRun({{$oneRun->id}})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
            </div>
            @endif
            @if($mode == 'deleted')
                <div class="actions_buttons flex">
                    <x-jet-checkbox wire:change="addToDeleteRunArr({{$oneRun->id}})" value="{{$oneRun->id}}"/>
                    @endif
                </div>

        </div>
    </td>
</tr>
@if($showDetails)
    <livewire:modals.run-details :run="$showDetails"/>
@endif
