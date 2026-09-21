<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SppBillController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentSppController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'role:admin'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('class-rooms', ClassRoomController::class);
    Route::resource('users', UserController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('spp-bills', SppBillController::class);
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    Route::get('/student/profile', [StudentProfileController::class, 'edit'])->name('student.profile');

    Route::patch('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');

    Route::get('/student/attendance', [StudentAttendanceController::class, 'index'])->name('student.attendance');

    Route::get('/student/spp', [StudentSppController::class, 'index'])->name('student.spp');

    Route::get('/student/spp/{id}', [StudentSppController::class, 'show'])->name('student.spp.show');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])
        ->name('teacher.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
