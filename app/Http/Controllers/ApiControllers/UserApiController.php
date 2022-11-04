<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        //return response()->json($this->userRepository->all(['first_name', 'role']), 200);
        return response()->json($this->userRepository->all(), 200);
    }

    public function show(int $id)
    {
        return response()->json($this->userRepository->findById($id), 200);
    }

    public function store(Request $request)
    {
        return response()->json($this->userRepository->create($request->all()), 201);
    }
}
