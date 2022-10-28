<x-layout>
    <form action="/register" method="POST">
        @csrf
        <label for="first_name">First Name</label>
        <input class="border border-gray-200 p-1 m-1 rounded" type="text" name="first_name" id="first_name">
        @error('first_name')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="last_name">Last Name</label>
        <input class="border border-gray-200 p-1 m-1 rounded" type="text" name="last_name" id="last_name">
        @error('last_name')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="email">Email</label>
        <input class="border border-gray-200 p-1 m-1 rounded" type="email" name="email" id="email">
        @error('email')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="password">Password</label>
        <input class="border border-gray-200 p-1 m-1 rounded" type="password" name="password" id="password">
        @error('password')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <button type="submit" class="border border-gray-200 rounded">Add user</button>
    </form>
</x-layout>