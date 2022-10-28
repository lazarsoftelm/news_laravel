<x-layout>
    <form action="/updateNews/{{ $news->id }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="title">News Title</label>
        <input class="border border-gray-200 p-1 m-1 rounded" 
        type="text" 
        name="title" 
        id="title" 
        value="{{ $news->title }}">
        @error('title')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="news_text">News Text</label>
        <textarea id="editor" name="news_text" placeholder="This is some sample content.">{{ $news->news_text }}</textarea>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
        @error('news_text')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="categorie_id">News Categorie</label>
        <select class="border border-gray-200 p-1 m-1 rounded" name="categorie_id" id="categorie_id">
            @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" {{$categorie->id == $news->categorie_id ? 'selected' : ''}} >{{ $categorie->name }}</option>
            @endforeach
        </select>

        @error('categorie_id')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="tags">News Tags</label>
        <br />
            @foreach($tags as $tag)
            <input type="checkbox" name="values[]" value="{{ $tag->id }}" {{in_array($tag->id, $newsTags) ? 'checked' : ''}}>
            <label>{{ $tag->name }}</label>
            @endforeach

        @error('tags')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <button type="submit" class="border border-gray-200 rounded">Save news</button>
    </form>
</x-layout>