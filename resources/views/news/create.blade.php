<x-layout>
    <form action="/addNews" method="POST">
        @csrf
        <label for="title">News Title</label>
        <input class="border border-gray-200 p-1 m-1 rounded" type="text" name="title" id="title">
        @error('title')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="news_text">News Text</label>
        <textarea id="editor" name="news_text" placeholder="This is some sample content."></textarea>
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
            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
            @endforeach
        </select>

        @error('categorie_id')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <label for="tags">News Tags</label>
        <br />
        <!-- <select class="border border-gray-200 p-1 m-1 rounded" name="tags" id="tags"> -->
            @foreach($tags as $tag)
            <input type="checkbox" name="values[]" value="{{ $tag->id }}">
            <label>{{ $tag->name }}</label>
            @endforeach
        <!-- </select> -->

        @error('tags')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
        <br />

        <button type="submit" class="border border-gray-200 rounded">Add news</button>
    </form>
</x-layout>