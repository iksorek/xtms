<tr class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-6 text-left whitespace-nowrap">
        <div class="flex items-center">
            <span
                class="{{$oneRun->finished ? ' text-green-600' : ''}} font-bold uppercase">{{$oneRun->postcode_from}} - {{$oneRun->postcode_to}}</span>
        </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">

            @if($oneRun->Customer && $oneRun->customer_id)
                <div class="flex justify-between w-full">
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
    <td class="py-3 px-6 text-center text-xs{{$oneRun->finished ? ' text-green-600' : ''}}">
        Start {{$oneRun->start_time}}<br>
        Eta Finish {{$oneRun->finish_est}}<br>
        {{$oneRun->finished ? 'Finished: ' . $oneRun->finished : 'Back est: ' . $oneRun->back_est}}

    </td>
    <td class="py-3 px-6 text-center">

        <button
            wire:click="updateColumn('paid')"
            class="{{$oneRun->paid ? 'bg-green-200' : 'bg-red-500'}} text-black py-1 px-3 rounded-full text-xs">{{$oneRun->paid ? 'Paid' : 'Unpaid'}}

        </button>
        <button
            wire:click="updateColumn('finished')"
            class="{{$oneRun->finished ? 'bg-green-200' : 'bg-red-200'}} py-1 px-3 rounded-full text-xs"

        >{{$oneRun->finished ? 'Finished' : 'Unfinished'}}

        </button>

    </td>
    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
            </div>
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="deleteRun">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        </div>
    </td>
</tr>
