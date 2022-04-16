<div class="flex flex-col">


    <button
        class="button-status {{$status == 'new' ? 'font-extrabold bg-yellow-500 outline-solid' : 'bg-yellow-300'}}"
        wire:click="setNewStatus('new')">New
    </button>
    <button class="button-status {{$status == 'requested' ? 'font-extrabold bg-red-500 outline-solid' : 'bg-red-300'}}"
            wire:click="setNewStatus('requested')">Requested
    </button>
    <button class="button-status text-sm {{$status == 'confirmed' ? 'font-extrabold bg-green-500 outline-solid' : 'bg-green-300'}}"
            wire:click="setNewStatus('confirmed')">Confirmed
    </button>
</div>
