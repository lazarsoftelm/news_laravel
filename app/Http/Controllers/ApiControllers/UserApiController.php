<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiUserRequest;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

    public function storeWithImage(StoreApiUserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-' . Str::uuid()->toString() . '.' . $extension;
            $data['image'] = Storage::disk('local')->putFileAs('public/images/profile', $file, $filename);
        } else {
            $data['image'] = 'images/profile/default_image.png';
        }

        $this->userRepository->create($data);
        return response()->json(['response' => ['code' => '200', 'message' => 'User created successfully']]);
    }

    public function update(StoreApiUserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasfile('image')) {
            $oldUser = $this->userRepository->findById($request['id']);
            Storage::delete($oldUser['image']);

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-' . Str::uuid()->toString() . '.' . $extension;
            $data['image'] = Storage::disk('local')->putFileAs('public/images/profile', $file, $filename);
        }

        $this->userRepository->update($request['id'], $data);

        return response()->json(['response' => ['code' => '200', 'message' => 'User updated successfully']]);
    }

    public function saveNews(Request $request)
    {   
        $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'news_id' => ['required', Rule::exists('news', 'id')]
        ]);

        $user = $this->userRepository->findById($request['user_id']);
        $user->savedNews()->attach($request['news_id']);

        return response()->json(['response' => ['code' => '200', 'message' => 'User saved news successfully']]);
    }

    public function detachSavedNews(Request $request)
    {   
        $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'news_id' => ['required', Rule::exists('news', 'id')]
        ]);

        $user = $this->userRepository->findById($request['user_id']);
        $user->savedNews()->detach($request['news_id']);

        return response()->json(['response' => ['code' => '200', 'message' => 'User detached saved news successfully']]);
    }

    // Sanctum token
    public function createToken(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($login)) {
            return response(['message' => 'Invalid credentials.']);
        }

        $token = Auth::user()->createToken($request->token_name);

        return response(['token' => $token->plainTextToken]);
    }
}
