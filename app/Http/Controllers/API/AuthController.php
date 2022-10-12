<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = User::where('email', auth()->user()->email)->first();
            $token = $user->createToken('token_name')->plainTextToken;
            return response()->json(
                [
                    'massage' => 'success',
                    'user' => $user,
                    'token' => $token
                ],
                200
            );
        } else {
            return response()->json([
                'massage' => 'unauthorized'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'massage' => 'sukses',
        ], 200);
    }
}
