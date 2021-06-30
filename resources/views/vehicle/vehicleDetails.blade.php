<x-app-layout>
    <x-slot name="header">
        <div
            class="w-3/4 mx-auto flex content-between justify-between text-sm sm:text-xl md:text-2xl font-bold text-gray-600">
            <p>{{$vehicle->make}} - {{$vehicle->model}}</p>
            <p>{{strtoupper($vehicle->reg)}} <br><span class="text-sm">{{$vehicle->mileage}} miles</span></p>

        </div>
    </x-slot>

    <div class="container-live">
        <livewire:vehicle-details :vehicle="$vehicle"/>
          </div>
</x-app-layout>
