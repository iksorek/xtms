<ul class="mt-6">

    @forelse($menu as $item => $value)
        <li class="relative px-6 py-3">
            @if(request()->routeIs($value))
                <x-dash.active-box-span/>
            @endif
            <a href="{{route($value)}}"
               class="menu_item {{request()->routeIs($value) ? ' menu_item-active' : ''}}">
                <span class="ml-4">{{$item}}</span>
            </a>
        </li>
    @empty
        THERE IS NO MENU
    @endforelse
</ul>
