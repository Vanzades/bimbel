<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Jadwal Kelas
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi jadwal pembelajaran.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3">
                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('schedules.update', $schedule) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="class_room_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Kelas
                        </label>

                        <select
                            name="class_room_id"
                            id="class_room_id"
                            required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                        >
                            <option value="">Pilih Kelas</option>

                            @foreach ($classRooms as $classRoom)
                                <option
                                    value="{{ $classRoom->id }}"
                                    @selected(old('class_room_id', $schedule->class_room_id) == $classRoom->id)
                                >
                                    {{ $classRoom->name }} ({{ $classRoom->code }})
                                </option>
                            @endforeach
                        </select>

                        @error('class_room_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Guru
                        </label>

                        <select
                            name="teacher_id"
                            id="teacher_id"
                            required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                        >
                            <option value="">Pilih Guru</option>

                            @foreach ($teachers as $teacher)
                                <option
                                    value="{{ $teacher->id }}"
                                    @selected(old('teacher_id', $schedule->teacher_id) == $teacher->id)
                                >
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('teacher_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                            Mata Pelajaran
                        </label>

                        <input
                            type="text"
                            name="subject"
                            id="subject"
                            value="{{ old('subject', $schedule->subject) }}"
                            required
                            maxlength="255"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                        >

                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="day" class="block text-sm font-medium text-gray-700 mb-1">
                                Hari
                            </label>

                            <select
                                name="day"
                                id="day"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >
                                <option value="">Pilih Hari</option>
                                <option value="monday" @selected(old('day', $schedule->day) === 'monday')>Senin</option>
                                <option value="tuesday" @selected(old('day', $schedule->day) === 'tuesday')>Selasa</option>
                                <option value="wednesday" @selected(old('day', $schedule->day) === 'wednesday')>Rabu</option>
                                <option value="thursday" @selected(old('day', $schedule->day) === 'thursday')>Kamis</option>
                                <option value="friday" @selected(old('day', $schedule->day) === 'friday')>Jumat</option>
                                <option value="saturday" @selected(old('day', $schedule->day) === 'saturday')>Sabtu</option>
                            </select>

                            @error('day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Jam Mulai
                            </label>

                            <input
                                type="time"
                                name="start_time"
                                id="start_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >

                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Jam Selesai
                            </label>

                            <input
                                type="time"
                                name="end_time"
                                id="end_time"
                                value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >

                            @error('end_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="room" class="block text-sm font-medium text-gray-700 mb-1">
                            Ruangan
                        </label>

                        <input
                            type="text"
                            name="room"
                            id="room"
                            value="{{ old('room', $schedule->room) }}"
                            maxlength="100"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                        >

                        @error('room')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                        >
                            <option value="active" @selected(old('status', $schedule->status) === 'active')>
                                Aktif
                            </option>
                            <option value="inactive" @selected(old('status', $schedule->status) === 'inactive')>
                                Tidak Aktif
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <a
                            href="{{ route('schedules.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-semibold hover:bg-gray-200"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm font-semibold hover:bg-gray-700"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
