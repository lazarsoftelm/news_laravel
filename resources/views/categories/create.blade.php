<x-layout>
    <form action="/addCategorie" method="POST">
        @csrf
        <label for="name">Categorie Name</label>
        <input class="border border-gray-200 p-1 m-1 rounded" type="text" name="name" id="name">
        @error('name')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <button type="submit" class="border border-gray-200 rounded">Add categorie</button>
    </form>
</x-layout>