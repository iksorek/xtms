<div class="text-center">
    <h2 class="text-2xl">Create new run</h2>

    <p class="font-bold m-3">Trip from {{$newrun['townStart']}} ({{$newrun['postcodesStart']}})
        to {{$newrun['townFinish']}}
        ({{$newrun['postcodesFinish']}})
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div>
            <x-jet-label for="cost">Final cost: (GBP)</x-jet-label>
            <x-jet-input wire:model="cost" name="cost"/>

            <x-jet-input-error for="cost"></x-jet-input-error>
            <br>
            <x-jet-label for="vehicle">Choose vehicle</x-jet-label>
            <select name="vehicle" wire:model="vehicle"
                    class="form_laravel">


                @if($vehicles->count() == 1)
                    <option value="null">SELECT LATER</option>
                    @foreach($vehicles as $oneVehicle)
                        <option value="{{$oneVehicle->id}}" selected>{{$oneVehicle->model}}
                            - {{$oneVehicle->reg}}</option>
                    @endforeach
                @elseif($vehicles->count() > 1)
                    <option value="null">SELECT LATER</option>
                    @foreach($vehicles as $oneVehicle)
                        <option value="{{$oneVehicle->id}}" {{check_vehicle($oneVehicle->id) ? 'disabled' : ''}}>{{$oneVehicle->model}} - {{$oneVehicle->reg}}</option>
                    @endforeach
                @else
                    <option value="null" selected>YOU HAVE NO VEHICLES!</option>
                @endif
            </select>

            <x-jet-label for="date">Choose a date</x-jet-label>
            <x-jet-input name="date" type="date" wire:model="date"/>
            <x-jet-input-error for="date"/>

            <x-jet-label for="startTime">Choose a time</x-jet-label>
            <x-jet-input name="startTime" type="time" wire:model="startTime"/>
            <x-jet-input-error for="startTime"/>
            <br>
            <x-jet-label for="additional_info">Additional info</x-jet-label>
            <textarea class="form_laravel" name="additional_info" wire:model="additional_info"></textarea>
            <x-jet-input-error for="additional_info"/>

        </div>
        <div>
            @if(!$addNewCustomerForm)
                <div class="choose_customer">
                    <x-jet-label for="customer">Customer</x-jet-label>
                    <select name="customer" size="5" class="form_laravel" wire:model="customer">
                        @foreach($customers as $oneCustomer)
                            <option value="{{$oneCustomer->id}}">{{$oneCustomer->name}}</option>
                        @endforeach
                    </select>
                    <p wire:click="$toggle('addNewCustomerForm')" class="hover:text-green-500 cursor-pointer my-5">
                        create new
                        customer</p>
                </div>
            @else
                <div class="new_customer">
                    <livewire:quick-new-customer/>

                    @if(!$customer)
                        <p wire:click="$toggle('addNewCustomerForm')" class="hover:text-green-500 cursor-pointer my-5">
                            Choose
                            from saved customers</p>
                    @endif
                </div>
            @endif

        </div>
    </div>

    @if($customer)
        <x-jet-button wire:click="saveNewRun" class="w-3/4 mt-3">
            Save run
        </x-jet-button>
    @endif

</div>
