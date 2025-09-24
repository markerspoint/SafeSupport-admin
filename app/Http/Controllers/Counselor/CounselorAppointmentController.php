<?php

namespace App\Http\Controllers\Counselor;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounselorAppointmentController extends Controller
{
    // Combined method: fetch appointments and return view
    public function index()
    {
        $appointments = Appointment::with(['student'])
            ->where('counselor_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('counselor.counselorAppointment', compact('appointments'));
    }

    // Update appointment via AJAX
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:appointments,id',
            'status' => 'required|string|in:pending,approved,rejected,cancelled',
            'notes' => 'nullable|string'
        ]);

        $appointment = Appointment::findOrFail($validated['id']);
        $appointment->status = $validated['status'];
        $appointment->notes = $validated['notes'] ?? null;
        $appointment->save();

        return response()->json(['success' => true]);
    }
}
