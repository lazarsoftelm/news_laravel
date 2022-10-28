<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index', ['tags' => Tags::all()]);
    }

    public function show(Tags $tag)
    {
        return view('tags.show', ['tag' => $tag]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store()
    {
        //ddd(request()->all());
        $attributes = request()->validate([
            'name' => ['required', 'max:255', 'min:3', Rule::unique('tags', 'name')],
        ]);

        //ddd($attributes);
        Tags::create($attributes);

        return redirect('/')->with('success', 'Your tag has been created.');
    }
}
