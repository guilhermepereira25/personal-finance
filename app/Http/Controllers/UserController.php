<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        if (!is_null($validated)) {
            $this->userRepository->createUser($validated);
        }

        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }

    public function show(Request $request)
    {
        $user = $this->userRepository->findUser($request->id);

        return response()->json([
            'data' => $user->getAttributes()
        ], 200);
    }
}
