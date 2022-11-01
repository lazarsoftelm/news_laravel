<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategorieController extends Controller
{
    public function index()
    {
        return view('categories.index', ['categories' => Categorie::all()]);
    }

    public function show(Categorie $categorie)
    {
        return view('categories.show', ['categorie' => $categorie]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {   
        Categorie::create($request->validated());

        return redirect('/')->with('success', 'Your categorie has been created.');
    }
}
