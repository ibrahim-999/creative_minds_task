<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Libraries\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    public function register(RegisterRequest $request){

        $user = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $plainTextToken = auth()->login($user);
        return ApiResponse::success([
            'token' => auth()->user()->createToken('register')->plainTextToken
        ]);
    }
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only('phone', 'password'))) {
            auth()->user()->tokens()->delete();
            return ApiResponse::success([
                'token' => auth()->user()->createToken('login')->plainTextToken
            ]);
        }
        return ApiResponse::fail('invalid credentials');
    }
    public function logout()
    {
        auth()->logout();
        return ApiResponse::success([
            'message' => 'Successfully logged out',
        ], 201);
    }
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
