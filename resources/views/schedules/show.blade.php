<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Jadwal
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap jadwal pembelajaran.
                </p>
            </div>

            <a
                href="{{ route('schedules.edit', $schedule) }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm font-semibold hover:bg-gray-700"
            >
                Edit Jadwal
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @php
                $days = [
                    'monday' => 'Senin',
                    'tuesday' => 'Selasa',
                    'wednesday' => 'Rabu',
                    'thursday' => 'Kamis',
                    'friday' => 'Jumat',
                    'saturday' => 'Sabtu',
                ];
            @endphp

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div>
                            <p class="text-sm text-gray-500">Mata Pelajaran</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">
                                {{ $schedule->subject }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">
                                {{ $schedule->classRoom->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $schedule->classRoom->code }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Guru</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">
                                {{ $schedule->teacher->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Hari</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">
                                {{ $days[$schedule->day] ?? $schedule->day }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Waktu</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Ruangan</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">
                                {{ $schedule->room ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Status</p>

                            <div class="mt-2">
                                @if ($schedule->status === 'active')
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    <a
                        href="{{ route('schedules.index') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900"
                    >
                        ← Kembali ke Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
