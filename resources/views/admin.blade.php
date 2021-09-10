<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('admin')
            Administration
            @else
                UNAUTHORIZED
                @endrole
        </h2>
    </x-slot>

    <div class="container-live">
        ADMIN
    </div>

</x-app-layout>
