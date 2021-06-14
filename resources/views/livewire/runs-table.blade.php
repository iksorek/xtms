<div class="overflow-x-auto">
    <div
        class="min-w-screen  bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
        <div class="w-full lg:w-5/6">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Run</th>
                        <th class="py-3 px-6 text-left">Client</th>
                        <th class="py-3 px-6 text-center">Date / time</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-xs font-light">
                    @foreach($myRuns as $index => $oneRun)
                        <livewire:runs-table.row :oneRun="$oneRun" :key="$oneRun->id">
                    @endforeach

                    </tbody>
                </table>
                @if($confirmingRunDeletion)
                    <livewire:modals.run-delete-confirmation :run="$confirmingRunDeletion"/>
                @endif
            </div>
        </div>
    </div>
</div>
