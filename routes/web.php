<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;

// Auth
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// counselor
use App\Http\Controllers\Counselor\CounselorDashboardController;
use App\Http\Controllers\Counselor\CounselorProfileController;
use App\Http\Controllers\Counselor\CounselorScheduleController;
use App\Http\Controllers\Counselor\CounselorAppointmentController;

// student
use App\Http\Controllers\Student\StudentAppointmentController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentDashboardController;

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
    Route::post('/counselor/appointments/update', [CounselorAppointmentController::class, 'update'])->name('counselor.appointments.update');
    Route::get('/counselor/schedule', [CounselorScheduleController::class, 'index'])->name('counselor.schedule');

    Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::put('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::post('/student/dashboard/appointments', [StudentDashboardController::class, 'store'])->name('student.dashboard.store');
    Route::get('/student/dashboard/appointments', [StudentDashboardController::class, 'ajaxAppointments'])->name('student.dashboard.appointments');
    Route::delete('/student/dashboard/appointments/{id}', [StudentDashboardController::class, 'destroy'])->name('student.dashboard.destroy');
    Route::get('/student/resources', [ResourceController::class, 'studentIndex'])->name('student.resources.index');
});


Route::middleware(['auth', 'role:counselor'])->prefix('counselor')->name('counselor.')->group(function () {
    Route::get('resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::get('resources/create', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('resources/edit/{id}', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::put('resources/{id}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('resources/{id}', [ResourceController::class, 'destroy'])->name('resources.destroy');
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