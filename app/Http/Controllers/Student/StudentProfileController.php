<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        return view('student.studentProfile', compact('student'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update user data
        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
