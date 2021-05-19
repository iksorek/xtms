

<div class="bg-{{$color}}-500 mx-1 px-3 rounded-2xl text-center has-tooltip">
    @if($type)
        {{$type}}
        <span class='tooltip text-{{$color}}-500 rounded shadow-lg p-1 bg-gray-100 text-red-500 -mt-6'>{{$tooltip}}</span>
    @endif
</div>
{{--<div class="hidden bg-green-500 bg-red-500 bg-yellow-500"></div>workaround pro purgeCss not removing dinamic clasees--}}
