<div>
    @if($vehs)
        <table class="table-auto w-full text-sm">
            <thead>
            <tr>
                <th>Make - Model</th>
                <th>Reg</th>
                <th>Mileage</th>
                <th>Runs planned</th>
                <th>INFORMATION</th>

            </tr>
            </thead>
            <tbody>


            @foreach($vehs as $veh)
                <tr class="text-center">
                    <td>{{ $veh->make }} {{$veh->model}}</td>
                    <td>{{\Illuminate\Support\Str::upper($veh->reg)}}</td>
                    <td>{{$veh->mileage}}</td>
                    <td>{{$veh->Runs()->count()}}</td>
                    <td class="flex content-center mx-auto">
                        <div class="flex mx-auto">
                            <x-vans.van-exp-date type='MOT' :date="$veh->mot"/>
                            <x-vans.van-exp-date type='INS' :date="$veh->insurance"/>
                            <x-vans.van-exp-date type='SERVICE' :date="[$veh->service, $veh->mileage]"/>
                        </div>

                    </td>


                    {{--                        @if($veh->mot < now())--}}
                    {{--                            <td class="bg-red-500">EXPIRED {{$veh->mot}}</td>--}}
                    {{--                        @else--}}
                    {{--                          <td class="bg-green-300">{{$veh->mot}}</td>--}}
                    {{--                        @endif--}}
                    {{--                    @if($veh->insurance < now())--}}
                    {{--                        <td class="bg-red-500">EXPIRED {{$veh->insurance}}</td>--}}
                    {{--                    @else--}}
                    {{--                        <td class="bg-green-300">{{$veh->insurance}}</td>--}}
                    {{--                    @endif--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
