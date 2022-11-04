<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        //return response()->json($this->TagRepository->all(['first_name', 'role']), 200);
        return response()->json($this->categoryRepository->all(), 200);
    }

    public function show(int $id)
    {
        return response()->json($this->categoryRepository->findById($id), 200);
    }

    public function store(Request $request)
    {
        return response()->json($this->categoryRepository->create($request->all()), 201);
    }
}
