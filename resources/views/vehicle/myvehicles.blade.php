<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            My vehicles
        </h2>

    </x-slot>



    <div class="container-live">
        <livewire:vehicle-list/>
    </div>
</x-app-layout>
