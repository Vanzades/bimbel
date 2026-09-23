<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tambah Akun Pengguna
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Buat akun login untuk Admin, Guru, atau Siswa
                </p>
            </div>

            <a
                href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pengguna
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Masukkan nama pengguna">

                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="contoh@email.com">

                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role
                        </label>

                        <select
                            name="role"
                            id="role"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>
                                Guru
                            </option>
                            <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>
                                Siswa
                            </option>
                        </select>

                        @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="teacher-field" class="hidden">
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Data Guru
                        </label>

                        <select
                            name="teacher_id"
                            id="teacher_id"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Guru</option>

                            @foreach ($teachers as $teacher)
                            <option
                                value="{{ $teacher->id }}"
                                {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }} — {{ $teacher->identity_number }}
                            </option>
                            @endforeach
                        </select>

                        @if ($teachers->isEmpty())
                        <p class="mt-2 text-sm text-amber-600">
                            Semua data guru aktif sudah memiliki akun atau belum tersedia.
                        </p>
                        @endif

                        @error('teacher_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="student-field" class="hidden">
                        <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Data Siswa
                        </label>

                        <select
                            name="student_id"
                            id="student_id"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Siswa</option>

                            @foreach ($students as $student)
                            <option
                                value="{{ $student->id }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} — {{ $student->identity_number }}
                            </option>
                            @endforeach
                        </select>

                        @if ($students->isEmpty())
                        <p class="mt-2 text-sm text-amber-600">
                            Semua data siswa aktif sudah memiliki akun atau belum tersedia.
                        </p>
                        @endif

                        @error('student_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Minimal 8 karakter">

                            @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">
                        <p class="text-sm text-gray-600">
                            Untuk akun Guru atau Siswa, akun akan otomatis dihubungkan dengan data master yang dipilih.
                        </p>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="px-4 py-2.5 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 bg-indigo-600 rounded-lg text-sm font-medium text-white hover:bg-indigo-700">
                            Buat Akun
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const role = document.getElementById('role');
            const teacherField = document.getElementById('teacher-field');
            const studentField = document.getElementById('student-field');
            const teacherSelect = document.getElementById('teacher_id');
            const studentSelect = document.getElementById('student_id');

            function updateFields() {
                teacherField.classList.add('hidden');
                studentField.classList.add('hidden');

                teacherSelect.removeAttribute('required');
                studentSelect.removeAttribute('required');

                if (role.value === 'guru') {
                    teacherField.classList.remove('hidden');
                    teacherSelect.setAttribute('required', 'required');
                }

                if (role.value === 'siswa') {
                    studentField.classList.remove('hidden');
                    studentSelect.setAttribute('required', 'required');
                }
            }

            role.addEventListener('change', updateFields);

            updateFields();
        });
    </script>
</x-app-layout>