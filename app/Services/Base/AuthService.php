<?php

namespace App\Services\Base;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginRequest $request): array
    {
        $user = Auth::user();
        $resource = new UserResource($user);
        $token = $user->createToken('API Token')->accessToken;

        return array_merge(
            $resource->toArray($request),
            [
                'token' => $token,
            ]
        );
    }

    public function logout(): void
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $user->save();
    }
}
