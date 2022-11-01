<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        // Ako hoces da se i prijavis odmah kao novokreirani korisnik
        //auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $data['role'] = 'user';
        $user = User::create($data);

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }

    public function showSubscribe()
    {
        $categories = Auth::user()->subscribedCategories;
        $categoriesArr = [];
        $categories->map(function ($cat) use (&$categoriesArr) {
            $categoriesArr[] = $cat->id;
        });
        return view('user.subscribe', [
            'categories' => Categorie::all(),
            'userCategories' => $categoriesArr
        ]);
    }

    public function storeSubscribe(StoreSubscriberRequest $request, User $user)
    {
        if ([] !== $request->safe()->only(['values'])) {
            $user->subscribedCategories()->sync($request->safe()->only(['values'])['values']);
        } else {
            $user->subscribedCategories()->sync([]);
        }

        return redirect('/')->with('success', 'You subscribed to new categories.');
    }
}
