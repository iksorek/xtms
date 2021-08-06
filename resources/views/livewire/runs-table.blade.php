<div>
    <x-jet-secondary-button wire:click="$set('mode', 'current')"
                            class="{{$mode == 'current' ? 'text-blue-500' : ''}}">Current
    </x-jet-secondary-button>
    <x-jet-secondary-button wire:click="$set('mode', 'old')" class="{{$mode == 'old' ? 'text-blue-500' : ''}}">Old
    </x-jet-secondary-button>
    <x-jet-secondary-button wire:click="$set('mode', 'deleted')"
                            class="{{$mode == 'deleted' ? 'text-blue-500' : ''}}">Deleted
    </x-jet-secondary-button>
    @if($mode == 'deleted' && count($myRuns) != 0)
        <x-jet-danger-button wire:click="deleteAllInTheBin">Delete all</x-jet-danger-button>

        @if(count($runsToDelete) != 0)
            <x-jet-danger-button wire:click="deleteSelected">Delete selected</x-jet-danger-button>
        @endif
    @elseif($mode == 'old' && count($myRuns) != 0)

        <x-jet-danger-button wire:click="deleteOldRuns">Move all to trash bin</x-jet-danger-button>
    @endif

    @if($myRuns->count() == 0)
        <p class="text-xl text-center shadow mt-4 uppercase">There is nothing here</p>
    @else


        <table class="border-collapse w-full text-sm mt-3">
            <thead>
            <tr>
                <th class="run_table_cell-name">
                    Route
                </th>
                <th class="run_table_cell-name">
                    Customer
                </th>
                <th class="run_table_cell-name">
                    Times
                </th>
                <th class="run_table_cell-name">
                    Status
                </th>
                <th class="run_table_cell-name">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($myRuns as $index => $oneRun)
                <livewire:runs-table.row :oneRun="$oneRun" :key="$oneRun->id" :mode="$mode"
                                         :runsToDelete="$runsToDelete">
            @endforeach
            </tbody>
        </table>

    @endif

</div>
