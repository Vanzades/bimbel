<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Riwayat Absensi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-950 antialiased">
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-md bg-slate-950 text-sm font-bold text-white">
                    B
                </div>

                <div>
                    <div class="text-sm font-semibold text-slate-950">
                        Bimbel
                    </div>

                    <div class="text-xs text-slate-500">
                        Student Portal
                    </div>
                </div>
            </a>

            <div class="flex items-center gap-4">
                <div class="hidden text-right sm:block">
                    <div class="text-sm font-medium text-slate-900">
                        {{ $student->name }}
                    </div>

                    <div class="text-xs text-slate-500">
                        Siswa
                    </div>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-sm font-medium text-slate-500 transition hover:text-slate-950"
                    >
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
        <div class="space-y-6">
            <div>
                <a
                    href="{{ route('student.dashboard') }}"
                    class="text-sm font-medium text-slate-500 transition hover:text-slate-950"
                >
                    ← Kembali ke Dashboard
                </a>

                <div class="mt-5">
                    <p class="text-sm font-medium text-slate-500">
                        Student Portal
                    </p>

                    <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-950">
                        Riwayat Absensi
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Pantau riwayat kehadiran kamu selama mengikuti pembelajaran.
                    </p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-slate-500">
                        Total
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-slate-950">
                        {{ $attendanceStats['total'] }}
                    </p>
                </div>

                <div class="border border-emerald-200 bg-emerald-50 p-5">
                    <p class="text-sm font-medium text-emerald-700">
                        Hadir
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-emerald-800">
                        {{ $attendanceStats['present'] }}
                    </p>
                </div>

                <div class="border border-blue-200 bg-blue-50 p-5">
                    <p class="text-sm font-medium text-blue-700">
                        Izin
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-blue-800">
                        {{ $attendanceStats['permission'] }}
                    </p>
                </div>

                <div class="border border-amber-200 bg-amber-50 p-5">
                    <p class="text-sm font-medium text-amber-700">
                        Sakit
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-amber-800">
                        {{ $attendanceStats['sick'] }}
                    </p>
                </div>

                <div class="border border-red-200 bg-red-50 p-5">
                    <p class="text-sm font-medium text-red-700">
                        Alpa
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-red-800">
                        {{ $attendanceStats['absent'] }}
                    </p>
                </div>
            </div>

            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-5 py-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-950">
                            Filter Absensi
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Gunakan filter untuk menemukan riwayat tertentu.
                        </p>
                    </div>
                </div>

                <form
                    method="GET"
                    action="{{ route('student.attendance') }}"
                    class="grid gap-4 p-5 sm:grid-cols-3"
                >
                    <div>
                        <label
                            for="status"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                        >
                            <option value="">Semua Status</option>
                            <option value="present" @selected(request('status') === 'present')>
                                Hadir
                            </option>
                            <option value="permission" @selected(request('status') === 'permission')>
                                Izin
                            </option>
                            <option value="sick" @selected(request('status') === 'sick')>
                                Sakit
                            </option>
                            <option value="absent" @selected(request('status') === 'absent')>
                                Alpa
                            </option>
                        </select>
                    </div>

                    <div>
                        <label
                            for="month"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Bulan
                        </label>

                        <select
                            id="month"
                            name="month"
                            class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                        >
                            <option value="">Semua Bulan</option>

                            @foreach ([
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ] as $number => $monthName)
                                <option
                                    value="{{ $number }}"
                                    @selected((string) request('month') === (string) $number)
                                >
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label
                            for="year"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Tahun
                        </label>

                        <select
                            id="year"
                            name="year"
                            class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                        >
                            <option value="">Semua Tahun</option>

                            @foreach (range(now()->year, now()->year - 5) as $year)
                                <option
                                    value="{{ $year }}"
                                    @selected((string) request('year') === (string) $year)
                                >
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2 sm:col-span-3">
                        <button
                            type="submit"
                            class="bg-slate-950 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800"
                        >
                            Terapkan Filter
                        </button>

                        <a
                            href="{{ route('student.attendance') }}"
                            class="border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                        >
                            Reset
                        </a>
                    </div>
                </form>
            </section>

            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Riwayat Kehadiran
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Daftar kehadiran berdasarkan data yang tercatat.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-slate-200 bg-slate-50">
                            <tr>
                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Tanggal
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Mata Pelajaran
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Kelas
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Status
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Catatan
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($attendances as $attendance)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-slate-700">
                                        {{ $attendance->date->translatedFormat('d F Y') }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="font-medium text-slate-900">
                                            {{ $attendance->schedule->subject ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        {{ $attendance->schedule->classRoom->name ?? '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="{{ match ($attendance->status) {
                                            'present' => 'bg-emerald-50 text-emerald-700',
                                            'permission' => 'bg-blue-50 text-blue-700',
                                            'sick' => 'bg-amber-50 text-amber-700',
                                            default => 'bg-red-50 text-red-700',
                                        } }} rounded-full px-2.5 py-1 text-xs font-medium">
                                            {{ match ($attendance->status) {
                                                'present' => 'Hadir',
                                                'permission' => 'Izin',
                                                'sick' => 'Sakit',
                                                default => 'Alpa',
                                            } }}
                                        </span>
                                    </td>

                                    <td class="max-w-xs px-5 py-4 text-slate-500">
                                        {{ $attendance->notes ?: '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-5 py-12 text-center"
                                    >
                                        <p class="text-sm font-medium text-slate-700">
                                            Belum ada data absensi
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Riwayat kehadiran akan muncul setelah data absensi dicatat.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($attendances->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4">
                        {{ $attendances->links() }}
                    </div>
                @endif
            </section>
        </div>
    </main>
</body>
</html>
