<x-layout>
    <main class="max-w-6xl mx-auto mt-1 lg:mt-20 space-y-6">
        @auth
        <span>Welcome back, {{ auth()->user()->first_name }}!</span>
        @endauth
        <br />
        <a href="/users">Users</a>
        @auth
        <br />
        <a href="/addUser">Add user</a>
        <br />
        <a href="/subscribe">Subscribe</a>
        @endauth
        <br />
        <a href="/tags">Tags</a>
        @auth
        <br />
        <a href="/addTag">Add tag</a>
        @endauth
        <br />
        <a href="/categories">Categories</a>
        @auth
        <br />
        <a href="/addCategorie">Add categorie</a>
        @endauth
        <br />
        <a href="/news">News</a>
        @auth
        <br />
        <a href="/addNews">Add news</a>
        @endauth
        @guest
        <br />
        <a href="/login">Login</a>
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