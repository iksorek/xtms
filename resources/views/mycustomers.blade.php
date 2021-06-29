<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My customers
        </h2>
    </x-slot>

    <div class="container-live">
        <livewire:customer-list/>
    </div>

</x-app-layout>
