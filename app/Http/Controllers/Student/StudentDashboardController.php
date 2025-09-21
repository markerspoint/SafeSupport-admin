<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;


class StudentDashboardController extends Controller
{
    public function index()
    {
        $appointments = auth()->user()
            ->appointments()
            ->with('counselor')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $counselors = \App\Models\User::where('role', 'counselor')->get();

        return view('student.studentDashboard', compact('appointments', 'counselors'));
    }


    public function store(Request $request)
    {
        try {
            $appointment = Appointment::create([
                'user_id' => auth()->id(),
                'counselor_id' => $request->counselor_id,
                'appointment_time' => $request->date . ' ' . $request->time,
                'reason' => $request->reason,
                'status' => 'pending',
            ]);

            return response()->json([
                'id' => $appointment->id,
                'counselor_name' => $appointment->counselor->name,
                'date' => $appointment->appointment_time->format('M d, Y'),
                'time' => $appointment->appointment_time->format('h:i A'),
                'status' => ucfirst($appointment->status),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
