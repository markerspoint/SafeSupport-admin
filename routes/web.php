<?php

use App\Http\Controllers\Counselor\CounselorAppointment;
use App\Http\Controllers\Counselor\CounselorAppointmentController;
use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// counselor
use App\Http\Controllers\Counselor\CounselorDashboardController;
use App\Http\Controllers\Counselor\CounselorProfileController;
use App\Http\Controllers\Counselor\CounselorScheduleController;

// student
use App\Http\Controllers\Student\StudentAppointmentController;
use App\Http\Controllers\Student\StudentProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/counselor/dashboard', [CounselorDashboardController::class, 'index'])->name('counselor.dashboard');
    Route::get('/counselor/profile', [CounselorProfileController::class, 'index'])->name('counselor.profile');
    Route::post('/counselor/profile/update', [CounselorProfileController::class, 'update'])->name('counselor.profile.update');
    Route::get('/counselor/appointment', [CounselorAppointmentController::class, 'index'])->name('counselor.appointment');
    Route::get('/counselor/appointment', [CounselorAppointmentController::class, 'appointments'])->name('counselor.appointment');
    Route::post('/counselor/appointments/update', [CounselorAppointmentController::class, 'updateAppointment'])->name('counselor.appointments.update');
    Route::get('/counselor/schedule', [CounselorScheduleController::class, 'index'])->name('counselor.schedule');


    Route::get('/student/appointment', [StudentAppointmentController::class, 'index'])->name('student.appointment');
    Route::get('/student/appointments', [StudentAppointmentController::class, 'appointments'])->name('student.appointments');
    Route::get('/student/appointments', [StudentAppointmentController::class, 'index'])->name('student.appointments.index');
    Route::post('/student/appointments', [StudentAppointmentController::class, 'store'])->name('student.appointments.store');
    Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
});


// Normal user login (students & counselors share this)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

// register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
// login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // student/counselor logout


// Admin login (separate page)
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout'); // Admin logout