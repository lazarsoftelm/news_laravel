<x-layout>
    <h1>Single user view</h1>
    <p>First name: {{ $user->first_name; }}</p>
    <p>Last name: {{ $user->last_name; }}</p>
    <p>Email: {{ $user->email; }}</p>
    <img 
        src="{{asset('/storage/' . substr($user->image, 7))}}" 
        alt="Profile picture"
        height="100px"
        width="100px">
</x-layout>