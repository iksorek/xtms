<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            Runs
        </h2>
        <p class="text-right">Active | Old | Trash</p>

    </x-slot>

    <div class="container-live">
        <livewire:runs mode="active"/>
    </div>
</x-app-layout>
