<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentAppointmentController extends Controller
{
    public function index()
    {

        $appointments = Appointment::with('counselor')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $counselors = User::where('role', 'counselor')->get();

        return view('student.studentAppointment', compact('appointments', 'counselors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'appointment_time' => 'required|date',
            'reason' => 'required|string|max:255',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'counselor_id' => $request->counselor_id,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        // For AJAX return the updated table HTML
        $appointments = Appointment::with('counselor')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $html = view('student.partials.appointments-table-body', compact('appointments'))->render();

        return response()->json(['html' => $html]);
    }

}
