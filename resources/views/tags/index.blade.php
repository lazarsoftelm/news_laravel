<x-layout>
    <p>Tag view</p>
    @foreach($tags as $tag)
        <a href="tags/{{$tag->id}}">{{ $tag->name; }}</a>
        <br />
    @endforeach
</x-layout>