<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Guru — {{ config('app.name', 'Bimbel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-950 antialiased">
    <div class="min-h-screen">

        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-16 max-w-[1600px] items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-950 text-sm font-bold text-white">
                        B
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-950">
                            Bimbel
                        </p>

                        <p class="text-xs text-slate-500">
                            Portal Guru
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-medium text-slate-900">
                            {{ $teacher->name }}
                        </p>

                        <p class="text-xs text-slate-500">
                            Guru
                        </p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950"
                        >
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

            <section class="mb-8">
                <p class="text-sm font-medium text-slate-500">
                    Dashboard Guru
                </p>

                <div class="mt-2 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-950 sm:text-3xl">
                            Selamat datang, {{ $teacher->name }}
                        </h1>

                        <p class="mt-2 text-sm text-slate-500">
                            Pantau kelas, siswa, dan jadwal mengajar Anda.
                        </p>
                    </div>

                    <div class="text-sm text-slate-500">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>
            </section>

            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="border border-slate-200 bg-white p-5">
                    <p class="text-sm text-slate-500">
                        Total Siswa
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-slate-950">
                        {{ $stats['students'] }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Siswa dari kelas yang diajar
                    </p>
                </div>

                <div class="border border-slate-200 bg-white p-5">
                    <p class="text-sm text-slate-500">
                        Kelas
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-slate-950">
                        {{ $stats['classes'] }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Kelas yang terkait
                    </p>
                </div>

                <div class="border border-slate-200 bg-white p-5">
                    <p class="text-sm text-slate-500">
                        Jadwal Aktif
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-slate-950">
                        {{ $stats['schedules'] }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Total jadwal mengajar
                    </p>
                </div>

                <div class="border border-slate-200 bg-white p-5">
                    <p class="text-sm text-slate-500">
                        Jadwal Hari Ini
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-slate-950">
                        {{ $stats['todaySchedules'] }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Jadwal mengajar hari ini
                    </p>
                </div>
            </section>

            <section class="mt-6 grid gap-6 xl:grid-cols-[1.5fr_1fr]">

                <div class="border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-slate-950">
                                    Jadwal Hari Ini
                                </h2>

                                <p class="mt-1 text-xs text-slate-500">
                                    Daftar kelas yang dijadwalkan hari ini.
                                </p>
                            </div>

                            <span class="text-sm font-medium text-slate-500">
                                {{ $todaySchedules->count() }} jadwal
                            </span>
                        </div>
                    </div>

                    @if ($todaySchedules->isEmpty())
                        <div class="px-5 py-12 text-center">
                            <p class="text-sm font-medium text-slate-700">
                                Tidak ada jadwal hari ini.
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Jadwal mengajar Anda akan muncul di sini.
                            </p>
                        </div>
                    @else
                        <div class="divide-y divide-slate-100">
                            @foreach ($todaySchedules as $schedule)
                                <div class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-950">
                                            {{ $schedule->subject }}
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $schedule->classRoom?->name ?? 'Kelas tidak tersedia' }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-4 text-sm">
                                        <div class="text-slate-600">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                            —
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        </div>

                                        @if ($schedule->room)
                                            <div class="text-slate-500">
                                                {{ $schedule->room }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <h2 class="text-base font-semibold text-slate-950">
                            Absensi Hari Ini
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Rekap absensi dari jadwal Anda hari ini.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-px bg-slate-200">
                        <div class="bg-white p-5">
                            <p class="text-xs text-slate-500">
                                Total
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-slate-950">
                                {{ $attendanceStats['total'] }}
                            </p>
                        </div>

                        <div class="bg-white p-5">
                            <p class="text-xs text-slate-500">
                                Hadir
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-emerald-600">
                                {{ $attendanceStats['present'] }}
                            </p>
                        </div>

                        <div class="bg-white p-5">
                            <p class="text-xs text-slate-500">
                                Izin
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-amber-600">
                                {{ $attendanceStats['permission'] }}
                            </p>
                        </div>

                        <div class="bg-white p-5">
                            <p class="text-xs text-slate-500">
                                Sakit
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-blue-600">
                                {{ $attendanceStats['sick'] }}
                            </p>
                        </div>

                        <div class="bg-white p-5 col-span-2">
                            <p class="text-xs text-slate-500">
                                Alpa
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-red-600">
                                {{ $attendanceStats['absent'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-6 border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-base font-semibold text-slate-950">
                        Informasi Guru
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Informasi akun dan data guru yang terdaftar.
                    </p>
                </div>

                <div class="grid gap-5 p-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="text-xs text-slate-500">
                            Nama
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-950">
                            {{ $teacher->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-500">
                            NIP / Identitas
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-950">
                            {{ $teacher->identity_number ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-500">
                            Email
                        </p>

                        <p class="mt-1 break-all text-sm font-medium text-slate-950">
                            {{ $teacher->email ?: $teacher->user?->email ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-500">
                            Status
                        </p>

                        <p class="mt-1 text-sm font-medium text-emerald-600">
                            {{ ucfirst($teacher->status) }}
                        </p>
                    </div>
                </div>
            </section>

        </main>
    </div>
</body>
</html>
