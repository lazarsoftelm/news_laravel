<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\EmojiRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmojiApiController extends Controller
{
    private $emojiRepository;

    public function __construct(EmojiRepositoryInterface $emojiRepository)
    {
        $this->emojiRepository = $emojiRepository;
    }

    public function index()
    {
        return response()->json($this->emojiRepository->all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'min:5'],
            'short_name' => ['required', 'min:5']
        ]);

        return response()->json($this->emojiRepository->create($request->all()), 201);
    }
}
