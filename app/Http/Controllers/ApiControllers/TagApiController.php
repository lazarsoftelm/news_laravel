<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\TagRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use stdClass;

class TagApiController extends Controller
{
    private $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        //return response()->json($this->TagRepository->all(['first_name', 'role']), 200);
        return response()->json($this->tagRepository->all(), 200);
    }

    public function show(int $id)
    {
        return response()->json($this->tagRepository->findById($id), 200);
    }

    public function showByName(string $name)
    {
        return response()->json($this->tagRepository->findByName($name), 200);
    }

    public function store(Request $request)
    {
        return response()->json($this->tagRepository->create($request->all()), 201);
    }
}
