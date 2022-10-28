<x-layout>
    <p>Users view</p>
    @foreach($users as $user)
        <a href="users/{{$user->id}}">{{ $user->first_name; }}</a>
        <br />
    @endforeach
</x-layout>