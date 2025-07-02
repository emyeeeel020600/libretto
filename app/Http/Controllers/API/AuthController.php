<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $existingToken = $user->tokens()->latest()->first();

        if ($existingToken) {
            $created = Carbon::parse($existingToken->created_at);
            if ($created->addDay()->isFuture() && $existingToken->plain_text_token) {
                return response()->json([
                    'token' => $existingToken->plain_text_token,
                    'message' => 'Reusing valid token',
                ]);
            }
        }

        // Token missing or expired — create a new one
        $user->tokens()->delete(); // optional: clear old ones

        $newToken = $user->createToken('libretto-token');
        $plain = $newToken->plainTextToken;

        // Store plain token in DB
        $tokenModel = $user->tokens()->latest()->first();
        $tokenModel->plain_text_token = $plain;
        $tokenModel->save();

        return response()->json([
            'token' => $plain,
            'message' => 'New token generated',
        ]);
    }

    public function logout(Request $request)
    {
        // 🟡 Do NOT delete the token. Just log user out on client side.
        return response()->json(['message' => 'Logged out (token still valid for reuse)']);
    }
}
