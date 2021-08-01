<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            Run Details
        </h2>

    </x-slot>
    <div class="container-live mx-auto">
        <livewire:runs.run-details :run="$run"/>
    </div>



</x-app-layout>
