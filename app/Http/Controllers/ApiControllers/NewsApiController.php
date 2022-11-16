<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsApiController extends Controller
{
    private $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        return response()->json($this->newsRepository->all(), 200);
    }

    public function show(int $id)
    {
        return response()->json($this->newsRepository->findById($id), 200);
    }

    public function store(Request $request)
    {
        $slug = implode(' ', array_slice(explode(' ', $request['title']), 0, 5));
        
        $slug = Str::of($slug)->slug('-');
        $request['slug'] = $slug;

        return response()->json($this->newsRepository->create($request->all()), 201);
    }

    public function addReaction(Request $request)
    {
        $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'news_id' => ['required', Rule::exists('news', 'id')],
            'reactions_id' => ['required', Rule::exists('reactions', 'id')]
        ]);

        $user = $this->userRepository->findById($request['user_id']);

        // Dodavanje u Reactions tabelu

        return response()->json($this->newsRepository->create($request->all()), 201);
    }
}
