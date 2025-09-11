<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function index() {
        $student = Auth::user();

        return view('student.studentProfile', compact('student'));
    }
}
