<div class="p-2 sm:p-4 md:p-8">
    @if($vehs->count() != 0)

        <table class="w-full text-xs md:text-sm">
            <thead>
            <tr>
                <th>Make - Model</th>
                <th>Reg</th>
                <th class="hidden sm:block">Mileage</th>
                <th>Runs planned</th>
                <th class="hidden sm:block">INFORMATION</th>

            </tr>
            </thead>
            <tbody>


            @foreach($vehs as $veh)

                <tr class="text-center">
                    <td>
                        <a href="{{route("vehicleDetails", ['vehicleID'=>$veh->id])}}">{{ $veh->make }} {{$veh->model}}</a>
                    </td>
                    <td>{{\Illuminate\Support\Str::upper($veh->reg)}}</td>
                    <td class="hidden sm:block">{{$veh->mileage}}</td>
                    <td>{{$veh->runs_count}}</td>
                    <td class="hidden sm:flex flex content-center mx-auto">
                        <div class="flex mx-auto">
                            <x-vans.van-exp-date type='MOT' :date="$veh->mot"/>
                            <x-vans.van-exp-date type='INS' :date="$veh->insurance"/>
                            <x-vans.van-exp-date type='TAX' :date="$veh->tax"/>
                            <x-vans.van-exp-date type='SERVICE' :date="[$veh->service, $veh->mileage]"/>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-xl">Seems like You have no vehicles. </p>

    @endif
</div>
