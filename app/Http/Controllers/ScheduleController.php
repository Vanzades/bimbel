<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['classRoom', 'teacher']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q
                    ->where('subject', 'like', "%{$search}%")
                    ->orWhere('room', 'like', "%{$search}%")
                    ->orWhereHas('teacher', function ($teacherQuery) use ($search) {
                        $teacherQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('classRoom', function ($classQuery) use ($search) {
                        $classQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('day')) {
            $query->where('day', $request->day);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        $schedules = $query
            ->orderByRaw("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday')")
            ->orderBy('start_time')
            ->paginate(10)
            ->withQueryString();

        $classRooms = ClassRoom::orderBy('name')->get();

        return view('admin.schedules.index', compact('schedules', 'classRooms'));
    }

    public function create()
    {
        $classRooms = ClassRoom::where('status', 'active')->orderBy('name')->get();

        $teachers = Teacher::where('status', 'active')->orderBy('name')->get();

        return view('admin.schedules.create', compact('classRooms', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_room_id' => ['required', 'exists:class_rooms,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject' => ['required', 'string', 'max:255'],
            'day' => [
                'required',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                ]),
            ],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $conflict = $this->findConflict($validated);

        if ($conflict) {
            return back()->withErrors([
                'start_time' => $conflict,
            ])->withInput();
        }

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kelas berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['classRoom', 'teacher']);

        return view('admin.schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $classRooms = ClassRoom::orderBy('name')->get();

        $teachers = Teacher::orderBy('name')->get();

        return view('admin.schedules.edit', compact('schedule', 'classRooms', 'teachers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'class_room_id' => ['required', 'exists:class_rooms,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject' => ['required', 'string', 'max:255'],
            'day' => [
                'required',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                ]),
            ],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $conflict = $this->findConflict($validated, $schedule->id);

        if ($conflict) {
            return back()->withErrors([
                'start_time' => $conflict,
            ])->withInput();
        }

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kelas berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal kelas berhasil dihapus.');
    }

    private function findConflict(array $data, ?int $scheduleId = null): ?string
    {
        $query = Schedule::where('day', $data['day'])
            ->where('status', 'active')
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time']);

        if ($scheduleId) {
            $query->where('id', '!=', $scheduleId);
        }

        $classConflict = (clone $query)->where('class_room_id', $data['class_room_id'])->exists();

        if ($classConflict) {
            return 'Jadwal kelas tersebut bentrok dengan jadwal lain pada hari dan waktu yang sama.';
        }

        $teacherConflict = $query->where('teacher_id', $data['teacher_id'])->exists();

        if ($teacherConflict) {
            return 'Guru tersebut sudah memiliki jadwal lain pada hari dan waktu yang sama.';
        }

        return null;
    }
}
