<div>
    @if($myRuns->count() == 0)
        <p class="text-xl text-center shadow">THERE IS NO RUNS PLANNED</p>
    @else

        <x-jet-secondary-button wire:click="$set('mode', 'current')"
                                class="{{$mode == 'current' ? 'text-blue-500' : ''}}">Current
        </x-jet-secondary-button>
        <x-jet-secondary-button wire:click="$set('mode', 'old')" class="{{$mode == 'old' ? 'text-blue-500' : ''}}">Old
        </x-jet-secondary-button>
        <x-jet-secondary-button wire:click="$set('mode', 'deleted')"
                                class="{{$mode == 'deleted' ? 'text-blue-500' : ''}}">Deleted
        </x-jet-secondary-button>
        @if($mode == 'deleted')
            <x-jet-danger-button>Delete all</x-jet-danger-button>
        @elseif($mode == 'old')

            <x-jet-danger-button>Move all to trash bin</x-jet-danger-button>
        @endif

        <table class="border-collapse w-full text-sm mt-3">
            <thead>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    Route
                </th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    Customer
                </th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    Times
                </th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    Status
                </th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($myRuns as $index => $oneRun)
                <livewire:runs-table.row :oneRun="$oneRun" :key="$oneRun->id">
            @endforeach
            </tbody>
        </table>

    @endif

</div>
