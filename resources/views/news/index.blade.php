<x-layout>
    <p>News view</p>
    @foreach($news as $singleNew)
        <a href="news/{{$singleNew->id}}">{{ $singleNew->title; }}</a>
        <br />
    @endforeach
</x-layout>