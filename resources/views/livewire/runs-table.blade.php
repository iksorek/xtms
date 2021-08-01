
@if($myRuns->count() == 0)
  <p class="text-xl text-center shadow">THERE IS NO RUNS PLANNED</p>
@else
    <table class="border-collapse w-full text-sm">
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

