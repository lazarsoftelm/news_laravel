<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', ['users' => User::all()]);
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        //ddd(request()->all());
        $attributes = request()->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', Rule::unique('users', 'password')],
        ]);

        $attributes['role'] = 'user';

        //ddd($attributes);
        $user = User::create($attributes);

        // Ako hoces da se i prijavis odmah kao novokreirani korisnik
        //auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }

    public function showSubscribe()
    {
        //ddd(Categorie::all());
        $categories = auth()->user()->categories;
        $categories = $categories->toArray();
        $categoriesArr = [];
        foreach ($categories as $cat) {
            array_push($categoriesArr, $cat['id']);
        }
        return view('user.subscribe', [
            'categories' => Categorie::all(),
            'userCategories' => $categoriesArr
        ]);
    }

    public function storeSubscribe(User $user)
    {
        $attributes = request()->validate([
            'values' => [Rule::exists('tags', 'id')]
        ]);

        $user->categories()->sync($attributes['values']);
        // ddd($attributes['values']);

        return redirect('/')->with('success', 'You subscribed to new categories.');
    }
}
