<x-layout>
    <p>Categorie view</p>
    @foreach($categories as $categorie)
        <a href="categories/{{$categorie->id}}">{{ $categorie->name; }}</a>
        <br />
    @endforeach
</x-layout>