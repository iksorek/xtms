<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            My vehicles
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{route("addVehicle")}}" class="bg-black text-xsm sm:text-sm text-gray-200 rounded px-2 py-1 font-bold m-2">New
                vehicle</a>
            <div class="bg-green-100 shadow-xl sm:rounded-lg text-center">
                <livewire:vehicle-list/>
            </div>
        </div>
</x-app-layout>
