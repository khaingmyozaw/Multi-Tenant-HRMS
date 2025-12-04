<?php

namespace App\Services\Base;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function register(array $request): Model
    {
        return User::create([
            'uuid' => Str::uuid(),
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }
}
