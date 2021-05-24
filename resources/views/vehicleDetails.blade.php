<x-app-layout>
    <x-slot name="header">
        <div
            class="w-3/4 mx-auto flex content-between justify-between text-sm sm:text-xl md:text-2xl font-bold text-gray-600">
            <p>{{$vehicle->make}} - {{$vehicle->model}}</p>
            <p>{{strtoupper($vehicle->reg)}} <br><span class="text-sm">{{$vehicle->mileage}} miles</span></p>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-100 shadow-xl sm:rounded-lg">
                <livewire:vehicle-details :vehicle="$vehicle"/>
            </div>
        </div>
    </div>
</x-app-layout>
