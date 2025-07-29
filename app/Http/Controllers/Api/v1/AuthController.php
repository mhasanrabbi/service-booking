<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @param AuthService $authService
     * @return RegisterResource
     */
    public function register(RegisterRequest $request, AuthService $authService)
    {
        $user = $authService->registerUser($request->validated());

        return new RegisterResource($user);
    }

    /**
     * @param LoginRequest $request
     * @return LoginResource|JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', Arr::get($data, 'email'))->first();

        if (empty($user)) {
            throw ValidationException::withMessages([
                'email' => "User doesn't exist."
            ]);
        }

        if (!Hash::check(Arr::get($data, 'password'), $user->password)) {
            return response()->json([
                'message' => 'Email or Password is wrong.'
            ], 401);
        }

        return new LoginResource($user);
    }
}
