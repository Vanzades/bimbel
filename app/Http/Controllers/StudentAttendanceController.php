<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $student = $user->student()->firstOrFail();

        $query = $student->attendances()
            ->with('schedule.classRoom')
            ->latest('date');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('month')) {
            $query->whereMonth('date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('date', $request->year);
        }

        $attendances = $query
            ->paginate(10)
            ->withQueryString();

        $attendanceStats = [
            'total' => $student->attendances()->count(),
            'present' => $student->attendances()->where('status', 'present')->count(),
            'permission' => $student->attendances()->where('status', 'permission')->count(),
            'sick' => $student->attendances()->where('status', 'sick')->count(),
            'absent' => $student->attendances()->where('status', 'absent')->count(),
        ];

        return view(
            'student.attendance',
            compact('student', 'attendances', 'attendanceStats')
        );
    }
}