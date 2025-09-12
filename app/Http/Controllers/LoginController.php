<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email','lowercase', 'max:255', 'unique:users'],
            'password' => ['required','min:3', 'confirmed']
        ]);
        $fields['isActive'] = 1;
        $user = User::create($fields);
        Auth::login($user);
        return redirect()
            ->route('dashboard')
            ->with('message', 'Welcome to Laravel Inertia Vue app');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email', 'lowercase'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();
            return Inertia::location(route('dashboard'));
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
