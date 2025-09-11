<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounselorScheduleController extends Controller
{
    public function index() {
        return view('counselor.counselorSchedule');
    }
}
