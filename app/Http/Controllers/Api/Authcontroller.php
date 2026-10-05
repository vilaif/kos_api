<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->create($request->validated());

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Registrasi Berhasil',
                'data' => [
                    'user' => new UserResource($user),
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => "Register gagal",
            ], 500);
        }

    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login Berhasil',
            'data' => [
                'user' => new UserResource($user),
                'access_token' => $token,
                'token_type' => 'Bearer'
            ],
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currenAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout Berhasil',
        ], 200);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => new UserResource($request->user()),
        ], 200);
    }
}