<x-layout>
    <main class="max-w-6xl mx-auto mt-1 lg:mt-20 space-y-6">
        @auth
        <span>Welcome back, {{ auth()->user()->first_name }}!</span>
        @endauth
        @auth
            @if(auth()->user()->role == 'admin')
            <br />
            <a href="/users">Users</a>
            <br />
            <a href="/addUser">Add user</a>
            @endif
        <br />
        <a href="/subscribe">Subscribe</a>
            @if(auth()->user()->role == 'admin')
            <br />
            <a href="/tags">Tags</a>
            <br />
            <a href="/addTag">Add tag</a>
            <br />
            <a href="/categories">Categories</a>
            <br />
            <a href="/addCategorie">Add categorie</a>
            @endif
        @endauth
        <br />
        <a href="/news">News</a>
        @auth
            @if(auth()->user()->role == 'admin')
            <br />
            <a href="/addNews">Add news</a>
            @endif
        @endauth
        @guest
        <br />
        <a href="/login">Login</a>
        <br />
        <a href="/register">Register</a>
        @endguest
        @auth
        <br />
        <form action="/logout" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endauth
    </main>
</x-layout>