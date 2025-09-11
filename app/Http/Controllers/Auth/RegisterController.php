<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => '', // null or '' if you prefer
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // default role
        ]);

        Auth::login($user); // optional: log them in immediately
        return redirect()->route('register')->with('success', 'Registration successful! You can now login.');
    }
}
