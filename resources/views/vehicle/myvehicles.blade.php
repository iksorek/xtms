<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            My vehicles
        </h2>

    </x-slot>



    <div class="bg-green-100 p-2 sm:p-4 md:p-8 mx-auto container">
        <livewire:vehicle-list/>
    </div>
</x-app-layout>
