<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSppController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $student = $user->student()->with('classRoom')->firstOrFail();

        $query = $student->sppBills();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $sppBills = $query->latest('year')->latest('month')->paginate(10)->withQueryString();

        $years = $student->sppBills()->select('year')->distinct()->orderByDesc('year')->pluck('year');

        $sppStats = [
            'total' => $student->sppBills()->count(),
            'paid' => $student->sppBills()->where('status', 'paid')->count(),
            'unpaid' => $student->sppBills()->where('status', 'unpaid')->count(),
            'pending' => $student->sppBills()->where('status', 'pending')->count(),
            'paidAmount' => $student->sppBills()->where('status', 'paid')->sum('amount'),
            'unpaidAmount' => $student->sppBills()->where('status', 'unpaid')->sum('amount'),
        ];

        return view('student.spp', compact('student', 'sppBills', 'years', 'sppStats'));
    }

    public function show(int $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $student = $user->student()->firstOrFail();

        $sppBill = $student->sppBills()->where('id', $id)->firstOrFail();

        return view('student.spp-show', compact('student', 'sppBill'));
    }
}
