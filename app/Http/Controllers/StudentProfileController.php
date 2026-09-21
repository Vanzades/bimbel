<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentProfileController extends Controller
{
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        $student = $user->student()->with('classRoom')->firstOrFail();

        return view('student.profile', compact('student'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $student = $user->student()->firstOrFail();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'gender' => [
                'required',
                Rule::in([
                    'male',
                    'female',
                ]),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'address' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);

        $student->update($validated);

        return redirect()->route('student.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
