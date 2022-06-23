<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * @param RegisterAuthRequest $request
     * @return JsonResponse
     */
    public function register(RegisterAuthRequest $request)
    {
        $protectPassword=bcrypt($request->password);
        $data=[
            'login'=>$request->input('login'),
            'password'=>$protectPassword,
            'email'=>$request->input('email'),
            'role_id'=>$request->input('role_id'),
            'real_name'=>$request->input('real_name'),
            'surname'=>$request->input('surname')
        ];
        $user = User::query()->create($data);
        $token = $user->createToken($request->login)->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    /**
     * @param LoginAuthRequest $request
     * @return JsonResponse
     */
    public function login(LoginAuthRequest $request)
    {
        $data=[
            'login'=>$request->input('login'),
            'password'=>$request->input('password'),
        ];

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        $user = User::query()->where('login', $data['login'])->first();
        $token = $user->createToken($data['login'])->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
