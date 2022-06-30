<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Requests\DestroyArticleRequest;
use App\Http\Requests\ShowArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param RegisterAuthRequest $request
     * @return string
     */
    public function register(RegisterAuthRequest $request): string
    {
        $protectPassword = bcrypt($request->password);
        $data = [
            'login' => $request->input('login'),
            'password' => $protectPassword,
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'real_name' => $request->input('real_name'),
            'surname' => $request->input('surname')
        ];
        $user = User::query()->create($data);
        $token = $user->createToken($request->login)->plainTextToken;

        return $token;
    }

    /**
     * @param LoginAuthRequest $request
     * @return string
     */
    public function login(LoginAuthRequest $request): string
    {
        $data = [
            'login' => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        $user = User::query()->where('login', $data['login'])->first();
        $token = $user->createToken($data['login'])->plainTextToken;

        return $token;
    }
}
