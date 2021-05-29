<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
          My vehicles  <a href="{{route('addVehicle')}}" class="bg-blue-900 text-lg rounded-lg px-4 py-2 text-white text-right">ADD NEW VEHICLE</a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-100 shadow-xl sm:rounded-lg text-center">
                <livewire:vehicle-list/>



        </div>
    </div>
</x-app-layout>
