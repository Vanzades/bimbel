<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\SppBill;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SppBillController extends Controller
{
    public function index(Request $request)
    {
        $query = SppBill::with(['student.classRoom']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where('name', 'like', "%{$search}%")->orWhere('identity_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_room_id')) {
            $query->whereHas('student', function ($studentQuery) use ($request) {
                $studentQuery->where('class_room_id', $request->class_room_id);
            });
        }

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sppBills = $query->latest('year')->latest('month')->paginate(10)->withQueryString();

        $classRooms = ClassRoom::orderBy('name')->get();

        $years = SppBill::query()->select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('admin.spp-bills.index', compact('sppBills', 'classRooms', 'years'));
    }

    public function create()
    {
        $students = Student::with('classRoom')->where('status', 'active')->orderBy('name')->get();

        return view('admin.spp-bills.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],
            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],
            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'status' => [
                'required',
                Rule::in([
                    'paid',
                    'unpaid',
                    'pending',
                    'failed',
                    'expired',
                ]),
            ],
            'paid_at' => [
                'nullable',
                'date',
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $exists = SppBill::where('student_id', $validated['student_id'])
            ->where('month', $validated['month'])
            ->where('year', $validated['year'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'student_id' => 'Tagihan SPP untuk siswa dan periode tersebut sudah ada.',
            ])->withInput();
        }

        if ($validated['status'] === 'paid' && empty($validated['paid_at'])) {
            $validated['paid_at'] = now();
        }

        if ($validated['status'] !== 'paid') {
            $validated['paid_at'] = null;
        }

        SppBill::create($validated);

        return redirect()->route('admin.spp-bills.index')->with('success', 'Tagihan SPP berhasil ditambahkan.');
    }

    public function show(SppBill $sppBill)
    {
        $sppBill->load(['student.classRoom']);

        return view('admin.spp-bills.show', compact('sppBill'));
    }

    public function edit(SppBill $sppBill)
    {
        $students = Student::with('classRoom')->orderBy('name')->get();

        return view('admin.spp-bills.edit', compact('sppBill', 'students'));
    }

    public function update(Request $request, SppBill $sppBill)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],
            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],
            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'status' => [
                'required',
                Rule::in([
                    'paid',
                    'unpaid',
                    'pending',
                    'failed',
                    'expired',
                ]),
            ],
            'paid_at' => [
                'nullable',
                'date',
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $exists = SppBill::where('student_id', $validated['student_id'])
            ->where('month', $validated['month'])
            ->where('year', $validated['year'])
            ->where('id', '!=', $sppBill->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'student_id' => 'Tagihan SPP untuk siswa dan periode tersebut sudah ada.',
            ])->withInput();
        }

        if ($validated['status'] === 'paid' && empty($validated['paid_at'])) {
            $validated['paid_at'] = now();
        }

        if ($validated['status'] !== 'paid') {
            $validated['paid_at'] = null;
        }

        $sppBill->update($validated);

        return redirect()->route('admin.spp-bills.index')->with('success', 'Tagihan SPP berhasil diperbarui.');
    }

    public function destroy(SppBill $sppBill)
    {
        $sppBill->delete();

        return redirect()->route('admin.spp-bills.index')->with('success', 'Tagihan SPP berhasil dihapus.');
    }
}
