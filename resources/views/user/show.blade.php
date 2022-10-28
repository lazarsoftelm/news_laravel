<x-layout>
    <h1>Single user view</h1>
    <p>First name: {{ $user->first_name; }}</p>
    <p>Last name: {{ $user->last_name; }}</p>
    <p>Email: {{ $user->email; }}</p>
</x-layout>