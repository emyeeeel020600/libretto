<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class WebAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Token reuse logic
        $existingToken = $user->tokens()->latest()->first();

        if ($existingToken) {
            $createdAt = Carbon::parse($existingToken->created_at);
            if ($createdAt->addDay()->isFuture() && $existingToken->plain_text_token) {
                session(['api_token' => $existingToken->plain_text_token]);
                return redirect()->intended('/'); // Token reused
            }
        }

        // Token is missing or expired → delete & generate new
        $user->tokens()->delete();

        $newToken = $user->createToken('libretto-token');
        $plainText = $newToken->plainTextToken;

        // Store plain token in DB
        $tokenModel = $user->tokens()->latest()->first();
        $tokenModel->plain_text_token = $plainText;
        $tokenModel->save();

        session(['api_token' => $plainText]);

        return redirect()->intended('/');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Generate token on registration
        $newToken = $user->createToken('libretto-token');
        $plainText = $newToken->plainTextToken;

        $tokenModel = $user->tokens()->latest()->first();
        $tokenModel->plain_text_token = $plainText;
        $tokenModel->save();

        session(['api_token' => $plainText]);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // We DO NOT delete the token — user can still reuse until expiry

        return redirect('/login');
    }
}
