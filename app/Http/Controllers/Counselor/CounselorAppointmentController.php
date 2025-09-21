<?php

namespace App\Http\Controllers\Counselor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounselorAppointmentController extends Controller
{
    public function index()
    {
        return view('counselor.counselorAppointment');
    }

    public function appointments()
    {
        $counselorId = Auth::id();

        $appointments = Appointment::with(['student'])
            ->where('counselor_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('counselor.counselorAppointment', compact('appointments'));
    }

    public function updateAppointment(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);
        $appointment->status = $request->status;
        $appointment->notes = $request->notes;
        $appointment->save();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'appointment' => $appointment]);
        }

        return redirect()->back()->with('success', 'Appointment updated successfully!');
    }

}