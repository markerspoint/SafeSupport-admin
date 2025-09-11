<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounselorProfileController extends Controller
{
    public function index()
    {
        $counselor = Auth::user();

        return view('counselor.counselorProfile', compact('counselor'));
    }

    public function update(Request $request)
    {
        $counselor = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $counselor->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $counselor->name = $request->name;
        $counselor->email = $request->email;

        if ($request->password) {
            $counselor->password = Hash::make($request->password);
        }

        $counselor->save();

        return redirect()->route('counselor.profile.update')->with('success', 'Profile updated successfully!');
    }

}
