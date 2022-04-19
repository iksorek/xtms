<x-app-layout>
    @role('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Administration
            @else
                UNAUTHORIZED

        </h2>
    </x-slot>

    <div class="container-live">
        <h2 class="text-xl text-center">Users list</h2>

        <livewire:admin.users-list/>
    </div>
    @endrole
</x-app-layout>
