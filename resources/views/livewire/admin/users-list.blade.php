<div>
    @foreach($users as $user)
        <p>{{$user->name}} has {{$user->Runs()->count()}} runs with {{$user->Vehicles()->count()}} vehicles</p>
    @endforeach
    <div class="pagination_nav">
        {{$users->links()}}
    </div>
</div>
