<x-layout>
    <h1>Subscribe to news categories</h1>
    <form action="/subscribe/{{auth()->user()->id}}" method="POST">
        @csrf
        @foreach($categories as $categorie)
            <input type="checkbox" name="values[]" value="{{ $categorie->id }}" {{in_array($categorie->id, $userCategories) ? 'checked' : ''}}>
            <label>{{ $categorie->name }}</label>
        @endforeach
        <br />
        <x-form.button>Subscribe</x-form.button>
    </form>
</x-layout>