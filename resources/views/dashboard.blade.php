<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(isset($mode) && $mode == 'requested')
        <h3>Requested runs</h3>
        <livewire:runs-blocks :mode="$mode"/>
    @elseif(!isset($mode))
        <livewire:runs-blocks/>
    @endif

</x-app-layout>
