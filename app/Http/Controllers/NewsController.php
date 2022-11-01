<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreNewsRequest;
use App\Models\Categorie;
use App\Models\News;
use App\Models\NewsTags;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{

    // public function __construct(Interface $faasdasd)
    // {
        
    // }

    public function index()
    {
        return view('news.index', ['news' => News::paginate(5)]);
    }

    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }

    public function create()
    {
        return view('news.create', ['categories' => Categorie::all(), 'tags' => Tags::all()]);
    }

    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->safe()->except(['values']));

        if ([] !== $request->safe()->only(['values'])) {
            $news->tags()->attach($request->safe()->only(['values'])['values']);
        }

        $subscribedUsers = $news->categorie()->first()->users()->get();

        $emails = [];
        $subscribedUsers->map(function ($user) use (&$emails) {
            $emails[$user['email']] = $user['first_name'] . " " . $user['last_name'];
        });

        if (count($emails) > 0) {
            $link = getenv('LOCALHOST') . "/news/{$news['id']}";
            Helper::email(
                $news['title'],
                $emails,
                "<p>Postovani, </p><br />
            <strong>Postavljena je nova vest u kategoriji za koju ste se pretplatili.</strong><br />
            <p>Vest mozete pogledati na sledecem <a href={$link}>linku</a>.</p>"
            );
        }

        return redirect('/')->with('success', 'Your news has been created.');
    }

    public function edit(News $news)
    {
        $tags = $news->tags;
        $tagsArr = [];
        $tags->map(function($tag) use(&$tagsArr){
            $tagsArr[] = $tag->id;
        });

        return view('news.edit', [
            'news' => $news,
            'categories' => Categorie::all(),
            'tags' => Tags::all(),
            'newsTags' => $tagsArr
        ]);
    }

    public function update(StoreNewsRequest $request, News $news)
    {
        $news->update($request->safe()->except(['values']));

        if ([] !== $request->safe()->only(['values'])) {
            $news->tags()->sync($request->safe()->only(['values'])['values']);
        } else {
            $news->tags()->sync([]);
        }

        return redirect('/')->with('success', 'Your news has been updated.');
    }
}
