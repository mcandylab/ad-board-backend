<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    public function auth(Request $request)
    {
        $attempt = Auth::attempt($request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8'
        ]));

        if ($attempt) {
            $user = User::where('email', $request['email'])->first();

            return response()->json(['token' => $user->createToken($user->email)->plainTextToken]);

        } else {
            return response()->json(['message' => 'These credentials do not match our records.'], 401);
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json(['token' => $user->createToken($user->email)->plainTextToken]);
    }

    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken();
    }
}
