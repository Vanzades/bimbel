<?php

namespace App\Http\Controllers;

use App\Models\SppBill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $student = $user->student()->with('classRoom')->first();

        if (!$student) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $sppBills = SppBill::where('student_id', $student->id)->latest('year')->latest('month')->get();

        $sppStats = [
            'total' => $sppBills->count(),
            'paid' => $sppBills->where('status', 'paid')->count(),
            'unpaid' => $sppBills->where('status', 'unpaid')->count(),
            'pending' => $sppBills->where('status', 'pending')->count(),
            'paidAmount' => $sppBills->where('status', 'paid')->sum('amount'),
            'unpaidAmount' => $sppBills->where('status', 'unpaid')->sum('amount'),
        ];

        $latestSppBill = $sppBills->first();

        return view('student.dashboard', compact('student', 'sppStats', 'latestSppBill'));
    }
}
