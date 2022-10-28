<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\News;
use App\Models\NewsTags;
use App\Models\Tags;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', ['news' => News::all()]);
    }

    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }

    public function create()
    {
        return view('news.create', ['categories' => Categorie::all(), 'tags' => Tags::all()]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'max:255'],
            'news_text' => ['required', 'max:255'],
            'categorie_id' => ['required', Rule::exists('categories', 'id')],
            'values' => [Rule::exists('tags', 'id')]
        ]);

        $news = News::create($attributes);

        if ($attributes['values']) {
            $news->tags()->attach($attributes['values']);
        }

        $newsCategorie = $news->categorie;
        $subscribedUsers = $newsCategorie->users;

        $emails = [];
        $names = [];
        foreach ($subscribedUsers as $user) {
            // array_push($emails, $user['email']);
            // array_push($names, $user['first_name']);
            $emails[$user['email']] = $user['first_name'] . " " . $user['last_name'];
        }


        //ddd($emails);
        if ($emails != []) {
            // ddd($emails);
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("vladanrstcmet@gmail.com", "Mr Vladan Ristic");
            $email->setSubject("{$news['title']}");
            $email->addTos($emails);
            //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
            $email->addContent("text/html",
            "<p>Postovani, </p><br />
            <strong>Postavljena je nova vest u kategoriji za koju ste se pretplatili.</strong><br />
            <p>Vest mozete pogledati na sledecem <a href='http://127.0.0.1:8000/news/{$news['id']}'>linku</a></p>"
            );
            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            try {
                $response = $sendgrid->send($email);
                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
            } catch (Exception $e) {
                echo 'Caught exception: ' . $e->getMessage() . "\n";
            }
        }

        return redirect('/')->with('success', 'Your news has been created.');
    }

    public function edit(News $news)
    {
        $tags = $news->tags;
        $tags = $tags->toArray();
        $tagsArr = [];
        foreach ($tags as $tag) {
            array_push($tagsArr, $tag['id']);
        }

        return view('news.edit', [
            'news' => $news,
            'categories' => Categorie::all(),
            'tags' => Tags::all(),
            'newsTags' => $tagsArr
        ]);
    }

    public function update(News $news)
    {
        $attributes = request()->validate([
            'title' => ['required', 'max:255'],
            'news_text' => ['required', 'max:255'],
            'categorie_id' => ['required', Rule::exists('categories', 'id')],
            'values' => [Rule::exists('tags', 'id')]
        ]);

        $news->update($attributes);
        $news->tags()->sync($attributes['values']);


        return redirect('/')->with('success', 'Your news has been updated.');
    }
}
