<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
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

    public function createToken(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid credentials.']);
        }

        $token = Auth::user()->createToken($request->token_name);

        return response(['token' => $token->plainTextToken]);
    }
}
