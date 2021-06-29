<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            My vehicles
        </h2>

    </x-slot>

    <a href="{{route("addVehicle")}}"
       class="button-like-link">
        New vehicle</a>
    <div class="bg-green-100 ">
        <livewire:vehicle-list/>
    </div>
</x-app-layout>
