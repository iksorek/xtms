<div class="flex">


    <button
        class="w-1/3 bg-yellow-300 m-1 {{$status == 'new' ? 'font-extrabold bg-yellow-500 outline-solid' : 'bg-yellow-300'}}"
        wire:click="setNewStatus('new')">New
    </button>
    <button class="w-1/3 bg-red-300 m-1 {{$status == 'requested' ? 'font-extrabold bg-red-500 outline-solid' : 'bg-red-300'}}"
            wire:click="setNewStatus('requested')">Requested
    </button>
    <button class="w-1/3 m-1 {{$status == 'confirmed' ? 'font-extrabold bg-green-500 outline-solid' : 'bg-green-300'}}"
            wire:click="setNewStatus('confirmed')">Confirmed
    </button>
</div>
