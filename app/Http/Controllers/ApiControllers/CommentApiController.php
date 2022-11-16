<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentApiController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        return response()->json($this->commentRepository->all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'news_id' => ['required', Rule::exists('news', 'id')],
            'comment_text' => ['required']
        ]);

        return response()->json($this->commentRepository->create($request->all()), 201);
    }
}
