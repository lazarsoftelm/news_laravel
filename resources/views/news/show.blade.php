<x-layout>
    <h1>Single news view</h1>
    <p>Title: {{ $news->title; }}</p>
    <p>News text: {!! $news->news_text; !!}</p>
    <p>Categorie: {{ $news->categorie->name; }}</p>
    <p>Tags: 
        @foreach($news->tags as $tag)
            <span class="badge rounded-pill bg-success">{{ $tag->name; }}</span>
        @endforeach
    </p>
    <a href="/editNews/{{$news->id}}">Edit news</a>
</x-layout>