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
        // Validate
        $fields = $request->validate([
            // 'avatar' => ['file', 'nullable', 'max:3000'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email','lowercase', 'max:255', 'unique:users'],
            'password' => ['required','min:3', 'confirmed']
        ]);

        // Save avatar if it exists
        // if ($request->hasFile('avatar')) {
        //     $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        // }
        $fields['isActive'] = 1;
        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // Redirect
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
            return redirect()->intended('dashboard');
            // return redirect()->route('dashboard');
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
