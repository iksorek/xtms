<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full">
            EDIT RUN
        </h2>

    </x-slot>
    {{--{{dd($run)}}--}}
    <div class="container-live">
        <livewire:edit-run :run="$run"/>
    </div>


</x-app-layout>
