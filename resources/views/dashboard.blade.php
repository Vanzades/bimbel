<x-admin-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <div class="space-y-8">
        <div>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Overview
                    </p>

                    <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-950">
                        Dashboard
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Ringkasan data dan aktivitas sistem bimbel.
                    </p>
                </div>

                <div class="text-sm text-slate-500">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="border border-slate-200 bg-white p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Akun
                        </p>

                        <p class="mt-2 text-2xl font-semibold text-slate-950">
                            {{ $stats['users'] }}
                        </p>
                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="border border-slate-200 bg-white p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Guru Aktif
                        </p>

                        <p class="mt-2 text-2xl font-semibold text-slate-950">
                            {{ $stats['teachers'] }}
                        </p>
                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            <path d="M8 6h8"/>
                            <path d="M8 10h6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="border border-slate-200 bg-white p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Siswa Aktif
                        </p>

                        <p class="mt-2 text-2xl font-semibold text-slate-950">
                            {{ $stats['students'] }}
                        </p>
                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M22 10 12 5 2 10l10 5 10-5Z"/>
                            <path d="M6 12.5V16c3 2 9 2 12 0v-3.5"/>
                            <path d="M22 10v6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="border border-slate-200 bg-white p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Kelas Aktif
                        </p>

                        <p class="mt-2 text-2xl font-semibold text-slate-950">
                            {{ $stats['classRooms'] }}
                        </p>
                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M3 21h18"/>
                            <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>
                            <path d="M9 7h6"/>
                            <path d="M9 11h6"/>
                            <path d="M9 15h6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="mb-4">
                <h2 class="text-lg font-semibold text-slate-950">
                    SPP
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan tagihan dan pembayaran SPP.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-slate-500">
                        Total Tagihan
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-slate-950">
                        {{ $stats['sppBills'] }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Seluruh tagihan SPP
                    </p>
                </div>

                <div class="border border-emerald-200 bg-emerald-50 p-5">
                    <p class="text-sm font-medium text-emerald-700">
                        SPP Lunas
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-emerald-800">
                        {{ $stats['sppPaid'] }}
                    </p>

                    <p class="mt-1 text-xs text-emerald-700">
                        Rp {{ number_format($stats['sppPaidAmount'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="border border-amber-200 bg-amber-50 p-5">
                    <p class="text-sm font-medium text-amber-700">
                        Belum Lunas
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-amber-800">
                        {{ $stats['sppUnpaid'] }}
                    </p>

                    <p class="mt-1 text-xs text-amber-700">
                        Rp {{ number_format($stats['sppUnpaidAmount'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="border border-blue-200 bg-blue-50 p-5">
                    <p class="text-sm font-medium text-blue-700">
                        Menunggu Pembayaran
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-blue-800">
                        {{ $stats['sppPending'] }}
                    </p>

                    <p class="mt-1 text-xs text-blue-700">
                        Pembayaran sedang diproses
                    </p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
            <section class="border border-slate-200 bg-white">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-950">
                            Jadwal Kelas
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Jadwal kelas aktif terbaru.
                        </p>
                    </div>

                    <a
                        href="{{ route('schedules.index') }}"
                        class="text-xs font-medium text-slate-600 transition hover:text-slate-950"
                    >
                        Lihat semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-slate-200 bg-slate-50">
                            <tr>
                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Hari
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Waktu
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Kelas
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Guru
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($latestSchedules as $schedule)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-900">
                                        {{ ucfirst($schedule->day) }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="font-medium text-slate-900">
                                            {{ $schedule->classRoom->name ?? '-' }}
                                        </div>

                                        @if ($schedule->classRoom?->code)
                                            <div class="mt-0.5 text-xs text-slate-500">
                                                {{ $schedule->classRoom->code }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        {{ $schedule->teacher->name ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="4"
                                        class="px-5 py-10 text-center text-sm text-slate-500"
                                    >
                                        Belum ada jadwal kelas aktif.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Ringkasan
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Statistik utama sistem.
                    </p>
                </div>

                <div class="divide-y divide-slate-100">
                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-600">
                            Jadwal Aktif
                        </span>

                        <span class="text-sm font-semibold text-slate-950">
                            {{ $stats['schedules'] }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-600">
                            Total Tagihan SPP
                        </span>

                        <span class="text-sm font-semibold text-slate-950">
                            {{ $stats['sppBills'] }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-600">
                            SPP Lunas
                        </span>

                        <span class="text-sm font-semibold text-emerald-600">
                            {{ $stats['sppPaid'] }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-600">
                            SPP Belum Lunas
                        </span>

                        <span class="text-sm font-semibold text-amber-600">
                            {{ $stats['sppUnpaid'] }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-600">
                            Nilai SPP Lunas
                        </span>

                        <span class="text-sm font-semibold text-slate-950">
                            Rp {{ number_format($stats['sppPaidAmount'], 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </section>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <section class="border border-slate-200 bg-white">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-950">
                            Guru Terbaru
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Data guru yang baru ditambahkan.
                        </p>
                    </div>

                    <a
                        href="{{ route('teachers.index') }}"
                        class="text-xs font-medium text-slate-600 transition hover:text-slate-950"
                    >
                        Lihat semua
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($latestTeachers as $teacher)
                        <div class="flex items-center gap-3 px-5 py-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-600">
                                {{ strtoupper(substr($teacher->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="truncate text-sm font-medium text-slate-900">
                                    {{ $teacher->name }}
                                </div>

                                <div class="mt-0.5 truncate text-xs text-slate-500">
                                    {{ $teacher->identity_number }}
                                </div>
                            </div>

                            <span class="{{ $teacher->status === 'active'
                                ? 'bg-emerald-50 text-emerald-700'
                                : 'bg-slate-100 text-slate-600' }}
                                rounded-full px-2.5 py-1 text-xs font-medium"
                            >
                                {{ $teacher->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-slate-500">
                            Belum ada data guru.
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="border border-slate-200 bg-white">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-950">
                            Siswa Terbaru
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Data siswa yang baru ditambahkan.
                        </p>
                    </div>

                    <a
                        href="{{ route('students.index') }}"
                        class="text-xs font-medium text-slate-600 transition hover:text-slate-950"
                    >
                        Lihat semua
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($latestStudents as $student)
                        <div class="flex items-center gap-3 px-5 py-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-600">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="truncate text-sm font-medium text-slate-900">
                                    {{ $student->name }}
                                </div>

                                <div class="mt-0.5 truncate text-xs text-slate-500">
                                    {{ $student->classRoom->name ?? 'Belum ada kelas' }}
                                </div>
                            </div>

                            <span class="{{ $student->status === 'active'
                                ? 'bg-emerald-50 text-emerald-700'
                                : 'bg-slate-100 text-slate-600' }}
                                rounded-full px-2.5 py-1 text-xs font-medium"
                            >
                                {{ $student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-slate-500">
                            Belum ada data siswa.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-admin-layout>
