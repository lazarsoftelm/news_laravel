<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
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

    public function store(StoreTagRequest $request)
    {
        Tags::create($request->validated());

        return redirect('/')->with('success', 'Your tag has been created.');
    }
}
