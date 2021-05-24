<div>
    <x-jet-banner/>
    @if($errors->any())
   <p class="text-2xl text-red-600 text-center m-2">{{ $errors->first() }}</p>
    @endif
    <table class="w-1/2 mx-auto">

        <tr>
            <td>
                <x-vans.van-exp-date type='MOT' :date="$vehicle->mot"/>
            </td>
            <td class="text-center">
                <input type="date"
                       min="{{date("Y-m-d")}}"
                       wire:model="newmot"
                       name="newmot"

                       class="bg-green-100 border-0"/>
            </td>
            <td class="text-center">
                <x-jet-button wire:click="saveNewMotDate" class="ml">Save new date</x-jet-button>
            </td>
        </tr>


        <tr>
            <td>
                <x-vans.van-exp-date type='INSURANCE' :date="$vehicle->insurance"/>
            </td>
            <td class="text-center">
                <input type="date"
                       wire:model="newInsurance"
                       min="{{date("Y-m-d")}}"
                       class="bg-green-100 border-0"/>
            </td>
            <td class="text-center">
                <x-jet-button wire:click="saveNewInsuranceDate" class="ml">Save new date</x-jet-button>
            </td>
        </tr>
        <tr>
            <td>
                <x-vans.van-exp-date type='SERVICE' :date="[$vehicle->service, $vehicle->mileage]"/>
            </td>
            <td class="text-center">
                <input type="number"
                       wire:model="newService"
                       name="newService"
                       class="bg-green-100 border-0"/>
            </td>
            <td class="text-center">
                <x-jet-button wire:click="saveNewService" class="ml">Save new service milage</x-jet-button>
            </td>
        </tr>
    </table>

</div>
