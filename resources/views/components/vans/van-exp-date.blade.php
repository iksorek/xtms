

<div class="
 {{ ($mode == 'info') ? 'bg-green-500' : ''}}
 {{ ($mode == 'warning') ? 'bg-yellow-500' : ''}}
 {{ ($mode == 'err') ? 'bg-red-500' : ''}}
 mx-0 px-3 border border-black  text-center has-tooltip">
    @if($type)
        {{$type}}
        <span class='tooltip text-{{$color}}-500 rounded shadow-lg p-1 bg-gray-100 text-red-500 -mt-6'>{{$tooltip}}</span>
    @endif
</div>
