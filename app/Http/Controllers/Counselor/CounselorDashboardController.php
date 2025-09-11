<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class CounselorDashboardController extends Controller
{
    public function index()
    {
        $counselorId = Auth::id();

        $acceptedCount = Appointment::where('counselor_id', $counselorId)
            ->where('status', 'accepted')
            ->count();

        $pendingCount = Appointment::where('counselor_id', $counselorId)
            ->where('status', 'pending')
            ->count();

        $rejectedCount = Appointment::where('counselor_id', $counselorId)
            ->where('status', 'rejected')
            ->count();


        $appointments = Appointment::selectRaw("DATE(appointment_time) as week")
            ->selectRaw("SUM(status = 'accepted') as accepted")
            ->selectRaw("SUM(status = 'pending') as pending")
            ->selectRaw("SUM(status = 'rejected') as rejected")
            ->where('counselor_id', $counselorId)
            ->groupBy('week')
            ->orderBy('week')
            ->get()
            ->map(function ($item) {
                $item->week_label = 'Week ' . $item->week . ' (' . $item->year . ')';
                return $item;
            });

        return view('counselor.counselorDashboard', compact('appointments', 'acceptedCount', 'pendingCount', 'rejectedCount'));
    }

}
