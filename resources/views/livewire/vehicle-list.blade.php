<div>
    @if($vehs)
        <h2>List of Your vehicles:</h2>
        <table class="table-auto w-full">
            <thead>
            <tr>
                <th>Make - Model</th>
                <th>Reg</th>
                <th>Milage</th>
                <th>Runs planned</th>
                <th>Mot expiry</th>
                <th>Insurance expiry</th>
            </tr>
            </thead>
            <tbody>


            @foreach($vehs as $veh)
                <tr class="text-center">
                    <td>{{ $veh->make }} {{$veh->model}}</td>
                    <td>{{\Illuminate\Support\Str::upper($veh->reg)}}</td>
                    <td>{{$veh->milage}}</td>
                    <td>{{$veh->Runs()->count()}}</td>

                        @if($veh->mot < now())
                            <td class="bg-red-500">EXPIRED {{$veh->mot}}</td>
                        @else
                          <td class="bg-green-300">{{$veh->mot}}</td>
                        @endif
                    @if($veh->insurance < now())
                        <td class="bg-red-500">EXPIRED {{$veh->insurance}}</td>
                    @else
                        <td class="bg-green-300">{{$veh->insurance}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
