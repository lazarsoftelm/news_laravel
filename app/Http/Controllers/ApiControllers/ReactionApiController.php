<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\ReactionRepositoryInterface;
use Illuminate\Http\Request;

class ReactionApiController extends Controller
{
    private $reactionRepository;

    public function __construct(ReactionRepositoryInterface $reactionRepository)
    {
        $this->reactionRepository = $reactionRepository;
    }

    public function index()
    {
        return response()->json($this->reactionRepository->all(), 200);
    }

    public function store(Request $request)
    {
        return response()->json($this->reactionRepository->create($request->all()), 201);
    }
}
