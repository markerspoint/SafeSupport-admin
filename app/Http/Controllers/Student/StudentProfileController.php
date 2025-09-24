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
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->ajax()) {
            return response()->json(['message' => 'Profile updated!']);
        }

        return redirect()->back()->with('success', 'Profile updated!');
    }

}
