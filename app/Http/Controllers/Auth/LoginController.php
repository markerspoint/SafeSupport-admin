<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'student') {
                return redirect()->route('student.appointment');
            } elseif ($user->role === 'counselor') {
                return redirect()->route('counselor.dashboard');
            } else {
                Auth::logout(); 
                return redirect()->route('login')->withErrors(['Invalid role.']);
            }
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); 
    }
}
